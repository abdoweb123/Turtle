<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\Subscriber\Http\Controllers\Controller;

Route::group(['prefix' => 'dashboard', 'as' => 'admin.'], function () {
    Route::group(['middleware' => [Localization::class, 'auth:admin']], function () {
        Route::resources(['subscribers' => Controller::class]);
    });
});
