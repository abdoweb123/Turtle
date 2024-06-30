<?php

use App\Http\Controllers\Client\AddressController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ResetPasswordController;
use App\Http\Controllers\Client\WishlistController;
use App\Http\Controllers\Payment\TapController;
use App\Http\Middleware\ForceSSL;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::group(['as' => 'Client.', 'middleware' => [Localization::class, ForceSSL::class]], function () {
    Route::GET('/', [HomeController::class, 'home'])->name('home');
    Route::GET('/device/{device_id?}/{color_id?}', [HomeController::class, 'device'])->name('device');
    Route::GET('/build-your-device/{device_id?}/{color_id}', [HomeController::class, 'BuildYourDevice'])->name('BuildYourDevice');
    Route::GET('/shoping-cart', [HomeController::class, 'cart'])->name('cart');
    Route::POST('/check-out/{delivery_id?}', [HomeController::class, 'confirm'])->name('confirm');
    Route::POST('/place-order/{delivery_id}', [HomeController::class, 'submit'])->name('submit');
    Route::get('change/country/{id}', [HomeController::class, 'changeCountry'])->name('changeCountry');


    // Category's Product
    Route::any('/categories/{category}/{search?}', [CategoryController::class, 'categoryProducts'])->name('categoryProducts');
    Route::any('/products/shop/{search?}', [CategoryController::class, 'shop'])->name('shop');
    //search ajax
    Route::any('/products/search', [HomeController::class, 'searchProducts'])->name('searchProducts');
    // product details
    Route::any('/product-details/{product}/{product_name?}', [HomeController::class, 'productDetails'])->name('productDetails');



     Route::group(['middleware' => ['auth:client']], function () {
        // Wishlist
        Route::POST('/toggle-wishlist', [WishlistController::class, 'ToggleWishlist'])->name('ToggleWishlist');
        Route::get('/wishlist', [WishlistController::class, 'getWishlist'])->name('getWishlist');
        Route::post('/wishlist/delete', [WishlistController::class, 'deleteWishlist'])->name('deleteWishlist');

         // Cart
         Route::GET('add-to-cart/', [CartController::class, 'addToCart'])->name('addToCart');
         Route::get('cart', [CartController::class, 'getCart'])->name('getCart');
         Route::GET('update-cart/', [CartController::class, 'updateCart'])->name('updateCart');
         Route::GET('/cart/delete', [CartController::class, 'deleteCart'])->name('deleteCart');

         // Address
         Route::GET('/update-address-shipping', [AddressController::class, 'updateAddressShipping'])->name('updateAddressShipping');
         Route::get('/get-regions-of-country', [AddressController::class, 'fetchRegionsForCountry'])->name('fetchRegionsForCountry');

         // checkout
         Route::post('/checkout-post', [CheckoutController::class, 'checkoutPost'])->name('checkoutPost');
         Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
         Route::get('/get-shipping-price/{weight}/{country_id}', [ProductController::class, 'findWeightPrice'])->name('findWeightPrice');
         Route::post('/save-checkout', [CheckoutController::class, 'saveCheckout'])->name('saveCheckout');
     });



    // make order
    Route::get('/submit-order/{payment_id}/{id?}', [CheckoutController::class, 'submitOrder'])->name('submitOrder');
    Route::view('/successful-order/{payment_id?}', 'Client.success-page')->name('successfulOrder');

    Route::POST('/cart-delete', [HomeController::class, 'deleteitem'])->name('deleteitem');
    Route::POST('/cart-plus', [HomeController::class, 'plus'])->name('plus');
    Route::POST('/cart-minus', [HomeController::class, 'minus'])->name('minus');

    Route::view('/services', 'Client.services')->name('services');
    Route::get('/faqs', [HomeController::class,'getFaqs'])->name('faqs');
    Route::get('/our-stores', [HomeController::class,'getStores'])->name('getStores');
    Route::view('/terms-conditions', 'Client.terms-conditions')->name('terms');
    Route::view('/settings/{type}', 'Client.settings')->name('settings');
    Route::view('/privacy', 'Client.privacy')->name('privacy');



    Route::any('/report/{device_id}/{size_id}/{color_id}/{specification_id}', [HomeController::class, 'report'])->name('report');
    Route::POST('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');

    // For client guest
    Route::group(['middleware' => ['guest:client']], function () {
        Route::view('/login', 'Client.login')->name('login');
        Route::POST('/login', [AuthController::class, 'login'])->name('login');

        Route::view('/register', 'Client.register')->name('register');
        Route::POST('/register', [AuthController::class, 'register'])->name('register');

        Route::view('/forgot-password', 'Client.lost-password')->name('password_request');
        Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('sendResetLinkEmail');
        Route::get('/password/reset/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('showResetForm');
        Route::post('/password/reset/', [ResetPasswordController::class, 'reset'])->name('password_update');


        Route::view('/forget', 'Client.forget')->name('forget');
        Route::POST('/forget', [AuthController::class, 'forget'])->name('forget');
    });


    Route::group(['middleware' => ['auth:client']], function () {
        Route::get('/my-account/{type?}', [AuthController::class,'getAccountPage'])->name('account');
        Route::POST('/my-account', [AuthController::class, 'account'])->name('account');
        Route::POST('/update-account', [AuthController::class, 'updateAccountDetails'])->name('updateAccountDetails');
        Route::any('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::POST('/update-shipping-address', [AddressController::class, 'updateShippingAddress'])->name('updateShippingAddress');
    });

    // Get sizes by color (ajax) in productDetails page
    Route::GET('products/sizes/by-color/', [HomeController::class, 'getSizesByColor'])->name('getSizesByColor');

    // get item by color, size (ajax)
    Route::GET('get/item/by-color-size/', [HomeController::class, 'getItemByColorSize'])->name('getItemByColorSize');



});
