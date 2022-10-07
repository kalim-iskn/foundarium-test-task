<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(\App\Http\Controllers\UserController::class)
    ->prefix("user")
    ->group(function () {
        Route::get("", "getList");

        Route::put("{userId}/auto/{autoId}", "setAuto")
            ->whereNumber('userId')
            ->whereNumber('autoId');

        Route::delete("auto/{autoId}", "freeAuto")
            ->whereNumber('autoId');
    });
