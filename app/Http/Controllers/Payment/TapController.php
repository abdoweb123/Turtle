<?php

namespace App\Http\Controllers\Payment;

use App\Functions\WhatsApp;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\Client\CheckoutController;
use App\Mail\OrderSummary;
use App\Models\Cart;
use Modules\Client\Entities\Model as Client;
use Modules\Order\Entities\Model as Order;
use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductItem as ProductItem;
//use App\Models\ProductSizeColor;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class TapController extends BasicController
{
    
     
    ////////////////Tap
    function VerifyTapTransaction($order_id,$payment_src)
    {
        $Order = Order::with(['client'])->find($order_id);

        $fields = (object) (object) [];

        $fields->amount = (float)$Order->net_total;
        $fields->currency = 'BHD';
        $fields->save_card = false;
        $fields->description = 'Description';
        $fields->statement_descriptor = 'Sample';

        $fields->metadata = (object) [];
        $fields->metadata->udf1 = $Order->id;

        $fields->reference = (object) [];
        $fields->reference->transaction = 'txn_0001';
        $fields->reference->order = 'ord_0001';

        $fields->receipt = (object) [];
        $fields->receipt->email = true;
        $fields->receipt->sms = true;

        $fields->customer = (object) [];
        $fields->customer->first_name = $Order->client->name;
        $fields->customer->middle_name = '';
        $fields->customer->last_name = '';
        $fields->customer->email = $Order->client->email ?? 'info@emcan-group.com';
        $fields->customer->phone = (object) [];
        $fields->customer->phone->country_code = str_replace("+", "", mainCountry()->phone_code);
        $fields->customer->phone->number = $Order->client->phone;

        $fields->merchant = (object) [];
        $fields->merchant->id = '';

        $fields->source = (object) [];
        $fields->source->id = $payment_src ?? 'src_all';

        $fields->post = (object) [];
        $fields->post->url = env('APP_URL');

        $fields->redirect = (object) [];
        $fields->redirect->url =  env('APP_URL') . '/payment/tap/response';

        $curl = curl_init();


        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tap.company/v2/charges',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>  json_encode($fields),
            CURLOPT_HTTPHEADER => array(': ','Authorization: Bearer '.env('TAP_SECRET'),'Content-Type: application/json'),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo 'cURL Error #:'.$err;
            $Order->delete();
        } else {
            $data = json_decode($response);
            try {
                $Order->transaction_number = $data->id;
                $Order->save();
                $redirect = $data->transaction->url;
                return redirect()->away($redirect);
            } catch (\Exception $e) {
                $Order->delete();
                $errorMessage = isset($data->errors[0]->description) ? $data->errors[0]->description : '$e->getMessage()';
                session()->flash('toast_message', ['type' => 'error', 'message' => $errorMessage]);
                toast($errorMessage, 'error');
                alert()->error($errorMessage);
                return redirect()->route('Client.home');
            }

        }
    }
    
    
    public function response()
    {
        $charge_data = $this->ResponseTapTransaction(env('TAP_SECRET'), request()->tap_id);
        $Order = Order::with('client')->where('transaction_number',request()->tap_id)->first();
        
        $Client = $Order->client;
        Transaction::create([
            'client_id' => $Client->id,
            'transaction_number' => $charge_data['id'],
            'value' => $charge_data['amount'],
            'result' => $charge_data['status'],
            'type' => 'TAP',
            'order_id' => $Order->id,

        ]);

        if($charge_data['status'] == 'PAID' || $charge_data['status'] == 'CAPTURED'){
            $Order->status = 0;
            $Order->save();

            $carts = Cart::where('client_id', client_id())->with('product')->get();
            foreach ($carts as $cart) {
                $Order->Products()->attach($cart->product->id, [
                    'price' => $cart->Product->RealPriceMainCountry(),
                    'item_id' => $cart->item_id,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'quantity' => $cart->quantity,
                    'total' => $cart->Product->RealPriceWithQuantityMainCountry($cart->quantity),
                ]);
                $product = Product::where('id', $cart->product_id)->decrement('quantity', $cart->quantity);
                $product_item = ProductItem::where('id',$cart->item_id)->decrement('quantity', $cart->quantity);
                $cart->delete();

                // To send order to Shipping Company
                if (shippingType() != 2){
                    CheckoutController::sendShippingCompany($Order);
                }
            }
            try {
                WhatsApp::SendOrder($Order->id);
            } catch (\Throwable $th) {

            }
            Mail::to(['main@turtlebh.com', setting('email'), $Client->email])->send(new OrderSummary($Order));
            session()->save();
            session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.order_added_successfully')]);
            alert()->success(__('trans.order_added_successfully'));
            alert()->success(__('trans.successProcess'));
            return redirect()->route('Client.successfulOrder');
        } else {
            $Order->delete();
            session()->flash('toast_message', ['type' => 'error', 'message' => __('trans.failedProcess')]);
            toast(__('trans.failedProcess'),'error');
            alert()->error(__('trans.failedProcess'));
            return redirect()->route('Client.home');
        }
    }
    
        
    function ResponseTapTransaction($token, $charge_id)
    {
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/charges/$charge_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $token
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    
        curl_close($curl);
        if ($err) {
            $response['status'] = 'cURL Error #:'.$err;
        }
        $response =  json_decode($response, true);
        return $response;
    }

} //en of class
