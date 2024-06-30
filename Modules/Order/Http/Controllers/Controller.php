<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Client\CheckoutController;
use App\Mail\OrderSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Order\Entities\Model;
use App\Functions\WhatsApp;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $query = Model::latest()->with('Branch', 'Client.Country', 'Products', 'Address');

        if ($request->has('from') && $request->has('to')) {
            $from = $request->input('from');
            $to = $request->input('to');
            $query->whereBetween('created_at', [$from, $to]);
        }

        $Models = $query->get();

        return view('order::index', compact('Models'));
    }


    public function destroy($id)
    {
        $Model = Model::where('id', $id)->delete();
    }

    public function changestatus(Request $request)
    {
        $Order = Model::where('id', $request->id)->first();

        $status = 'success';

        if($Order->delivery_id == 1 || $Order->delivery_id == 3){
            if( $request->status == 4){
                $this->updateStatus($Order,$request->status);
                $msg =  'order_rejected';
            }
            elseif( $request->status == 0){
                $this->updateStatus($Order,$request->status);
                $msg =  'order_pending';
            }
            elseif( $request->status == 1){
                $this->updateStatus($Order,$request->status);
                $msg =  'order_preparing';
            }
            elseif( $request->status == 2){
                $this->updateStatus($Order,$request->status);
                $msg =  'order_ready';
            }
            else{

                // if shipping outside the main_country (Bahrain)
                $shippingResult = CheckoutController::sendShippingCompany($Order);
                if ($shippingResult !== true) {
                    // If there's an error, redirect back with the error message
                     $status = 'error';
                     $msg = $shippingResult;
                }else{
                    $this->updateStatus($Order,$request->status);
                    $msg = 'order_delivered';
                }

            }
        }



        $message  = '%0a *(' .env('APP_NAME').')* %0a';
        $message .= '%0a *Order Number :* ' . $Order->id;
        $message .= '%0a '.__('trans.'.$msg).' %0a';
        $message .= '%0a *Powered By Emcan Solutions* %0a';

        try {
            Mail::to(['apps@emcan-group.com', setting('email'), $Order->client()->first()->email])->send(new OrderSummary($Order));
        } catch (\Throwable $th) {

        }

       return $response = response()->json([
            'status' => $status ?? null,
            'message' => __('trans.'.$msg),
        ]);

    }


    public function updateStatus($Order,$status)
    {
        $Order->status = $status;
        $Order->save();
    }


}
