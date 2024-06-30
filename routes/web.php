<?php

use App\Functions\WhatsApp;
use App\Http\Controllers\Payment\TapController;
use App\Http\Controllers\webController;
use App\Http\Middleware\ForceSSL;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;


use Modules\Order\Entities\Model as Order;
use App\Mail\OrderSummary;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('change-country/{id}', [webController::class, 'SetCountry'])->name('change-country');
Route::any('get-ip-details', [webController::class, 'ip'])->name('ip');
Route::any('reorder', [webController::class, 'reorder'])->name('reorder');
Route::any('language/{locale}', [webController::class, 'lang'])->name('lang');
Route::any('artisan/{command}', [webController::class, 'artisan'])->name('artisan');
Route::any('sendotp/{number}', [webController::class, 'SendOTP'])->name('SendOTP');
Route::any('removeids', [webController::class, 'RemoveIds'])->name('RemoveIds');
Route::any('switch', [webController::class, 'switch'])->name('switch');
Route::any('country_regions/{country_id}', [webController::class, 'country_regions'])->name('country_regions');


//payment
Route::group(['as' => 'client.','middleware' => [Localization::class,ForceSSL::class]], function () {
    Route::group(['prefix' => 'payment','as' => 'payment.'], function () {
        Route::group(['prefix' => 'tap','as' => 'tap.'], function () {
            Route::any('init', [TapController::class,'init'])->name('init'); // client.payment.tap.init
            Route::any('response', [TapController::class,'response'])->name('response'); // client.payment.tap.response
        });
    });
});


Route::any('testMail/{id}', function ($id){
    $order = Order::where('id',$id)->first();

//    return $order->Products[0];

//    return view('emails.order_summary',compact('order'));

    WhatsApp::SendOrder($order->id);

//    Mail::to(['main@turtlebh.com', 'bs8111939@gmail.com', 'megypt@gmail.com'])->send(new OrderSummary($order));

});
