<?php

namespace App\Http\Controllers\Client;

use App\Functions\Oreem;
use App\Functions\WhatsApp;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\Payment\TapController;
use App\Http\Requests\Client\AddressRequest;
use App\Http\Requests\SaveCheckoutRequest;
use App\Mail\OrderSummary;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Address\Entities\Model as Address;
use Modules\Client\Entities\Model as Client;
use Modules\Country\Entities\Region;
use Modules\Order\Entities\Model as Order;
use Modules\Payment\Entities\Model as Payment;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductItem;
use Modules\Product\Http\Controllers\ProductController;

class CheckoutController extends BasicController
{

    /*** checkoutPost to save shippingType in session ***/
    public function checkoutPost(Request $request)
    {
        $request->validate([
            'shipping_type'=>'required|in:1,2,3'
        ]);

        shippingType($request->input('shipping_type'));

        return redirect()->route('Client.checkout');
    }


    /*** Go to checkout page ***/
    public function checkout()
    {
        $payments = Payment::Active()->get();

        $cart = Cart::where('client_id', client_id())->with('product')->get();

        // To get weight and price of cart's products
        $totalWeightPrice = ProductController::getWeightAndPrice($cart);

        if (count($cart) == 0){ // if no cart products
            return redirect()->back();
        }

        $subTotalCart = CheckoutController::getTotalCart($cart);

        $vat = (setting('vat')/100) * $subTotalCart;

        return view('Client.checkout',compact('cart','subTotalCart','payments','vat','totalWeightPrice'));
    }


    /*** save checkout ***/
    public function saveCheckout(SaveCheckoutRequest $request)
    {
        // if create account == 1 create account
        if (!auth('client')->check())
        {
            $client = Client::query()->updateOrCreate
            (
                [
                    'email'=>$request->email_address,
                    'phone'=>$request->phone_billing,
                ],
                [
                    'email'=>$request->email_address,
                    'phone'=>$request->phone_billing,
                    'name'=>$request->first_name,
                ]
            );

            auth('client')->login($client);
            $this->convertGuestDataToClient();
        }


        if ($request->country_id){
            // update shipping address
            $addressShipping = Address::query()->updateOrCreate
            (
                ['client_id' => client_id()],
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'country_id' => $request->country_id,
                    'address1' => $request->address1,
                    'address2' => $request->address2,
                    'city' => $request->city,
                    'state' => $request->state,
                    'region_id' => $request->region_id,
                    'block' => $request->block,
                    'road' => $request->road,
                    'building_no' => $request->building_no,
                    'floor_no' => $request->floor_no,
                    'apartment' => $request->apartment,
                    'apartmentType' => $request->apartmentType,
                    'additional_directions' => $request->additional_directions,
                    'gift_color' => $request->gift_color,
                    'gift_comment' => $request->gift_comment,
                ]
            );
        }


        return redirect()->route('Client.submitOrder',[$request->payment_id,$addressShipping->id??'']);
    }


    /*** submit order ***/
    public function submitOrder($payment_id,$id=null)
    {
        try {
            DB::beginTransaction();

            $carts = Cart::where('client_id', client_id())->with('product')->get();
            $subTotalCart = $this->calcSubtotalCart($carts);

            // To get weight and price of cart's products
            $totalWeightPrice = ProductController::getWeightAndPrice($carts);

            $shippingValue = shippingType() == '1' ? setting('internal_shipping_cost') : (shippingType() == '3' ? $totalWeightPrice['totalCartWeightPrice'] : 0);
            $addressShipping =  Address::query()->where('client_id',client_id())->where('id',$id)->first();
            $vat = ((setting('vat')/100) * $subTotalCart['sub_total']);

            $Order = Order::create([
                'client_id' => Client_id(),
                'delivery_id' => shippingType(),
                'address_id' => $addressShipping ? $addressShipping->id : null,
                'payment_id' => $payment_id,
                'sub_total' => $subTotalCart['sub_total_before_discount'],
                'discount' => $subTotalCart['discount'],
                'discount_percentage' => $subTotalCart['totalDiscountPercentage'],
                'charge_cost' => $shippingValue,
                'vat' => $vat,
                'vat_percentage' => setting('vat'),
                'net_total' => $subTotalCart['sub_total'] + $shippingValue + $vat,
            ]);

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
            }

            Transaction::create([
                'client_id' => $Order->client_id,
                'value' =>$Order->net_total,
                'result' => 'NOT_PAID',
                'type' => 'CASH',
                'order_id' => $Order->id,
            ]);

            DB::commit();

            // if payment is not cash
            if ($Order->payment_id != 1) {
                $TapController = new TapController();
                $payment = Payment::query()->where('id',$payment_id)->firstOrFail();

                return $TapController->VerifyTapTransaction($Order->id,$payment->tap_src);
            }

//            // if shipping outside the main_country (Bahrain)
//            if (shippingType() != 2){
//                $shippingResult = self::sendShippingCompany($Order);
//                if ($shippingResult !== true) {
//                    // If there's an error, redirect back with the error message
//                    return redirect()->back()->withErrors(['error' => $shippingResult]);
//                }
//            }

            try {
                WhatsApp::SendOrder($Order->id);
                $client = auth('client')->user()?? $addressShipping;
                Mail::to(['main@turtlebh.com', setting('email'), $client->email])->send(new OrderSummary($Order));
            } catch (\Throwable $th) {

            }


        } catch (\Exception $e) {
            $Order->delete();
            DB::rollback();
            Log::error('Database transaction failed: ' . $e->getMessage());

            // Create a custom validation error message
            $validator = Validator::make([], []); // Empty data and rules, we'll add a message manually
            $validator->errors()->add('error', __('trans.error_while_processing') . $e->getMessage());
            return redirect()->back()->withErrors($validator);
        }

        return redirect()->route('Client.successfulOrder',$payment_id);
    }


    // Get total cart
    public static function getTotalCart($cart)
    {
        $subTotal = 0;
        foreach ($cart as $cartItem) {
            if ($cartItem->product->discount_value && $cartItem->product->discount_from < now() && $cartItem->product->discount_to > now()) {
                $subTotalCart = ($cartItem->product->price - ($cartItem->product->price / 100 * $cartItem->product->discount_value)) * Country()->currancy_value;
            } else {
                $subTotalCart = $cartItem->product->price * Country()->currancy_value;
            }
            $subTotal = $subTotal + ($subTotalCart * $cartItem->quantity);
        }
        return  $subTotal;
    }


    // calcSubtotalCart (sub_total_before_discount, sub_total, discount)
    public function calcSubtotalCart($carts)
    {
        $sub_total = 0;
        $sub_total_before_discount = 0;
        $discount = 0;
        foreach ($carts as $cart){
            if ($cart->Product->HasDiscount()){
                $sub_total_before_discount += $cart->Product->price * $cart->quantity;
                $sub_total += $cart->Product->price * $cart->quantity - ($cart->Product->price * $cart->quantity / 100 * $cart->Product->discount_value);
                $discount += ($cart->Product->price * $cart->quantity) * ($cart->Product->discount_value/100) ;
            }
            else{
                $sub_total += $cart->Product->price * $cart->quantity;
                $sub_total_before_discount = $sub_total;
            }
        }

        $totalDiscountPercentage = round((($discount/$sub_total_before_discount) * 100),2);

        $result = [
            'sub_total_before_discount' => $sub_total_before_discount,
            'sub_total' => $sub_total,
            'discount' => $discount,
            'totalDiscountPercentage' => $totalDiscountPercentage,
        ];

        return $result;
    }


    // To convert [wishlist, orders, addresses, cart] of guest to client
    public function convertGuestDataToClient()
    {
        $guest_id = session()->get('client_id');
        if ($guest_id){
            DB::table('wishlist')->where('client_id', $guest_id)->update(['client_id' => auth('client')->id()]);
            DB::table('orders')->where('client_id', $guest_id)->update(['client_id' => auth('client')->id()]);
            DB::table('addresses')->where('client_id', $guest_id)->update(['client_id' => auth('client')->id()]);
            DB::table('cart')->where('client_id', $guest_id)->update(['client_id' => auth('client')->id()]);
        }
    }

 
    static function sendShippingCompany($Order)
    {
        $Task = Oreem::CreateTask($Order);
        if ($Task && isset($Task['status']) && $Task['status'] == 200) {
            $Order->store_tracking_link = $Task['tracking_url'];
            $Order->client_tracking_link = $Task['tracking_url'];
            $Order->save();
            return true; // Success
        }else {
            // Handle other possible errors
            $errorMessage = isset($Task['message']) ? $Task['message'] : 'Unknown error';
            if (is_array($errorMessage)) {
                $errorMessage = implode(', ', $errorMessage);
            }

            Log::error('Error creating task: ' . $errorMessage);
            return $errorMessage;
        }
    }

} //end of class
