<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');

});
Route::group([
    'middleware' => ['api', 'auth'],
], function ($router) {
    Route::controller(BrandsController::class)->group(function () {
        Route::group(["prefix" => "brand"], function () {
            Route::get("index", "index");
            Route::get("show/{id}", "show");
            Route::put("update/{id}", "update_brand");
            Route::post("store", "store");
            Route::delete("delete/{id}", "delete");
        });
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::group(["prefix" => "category"], function () {
            Route::get("index", "index");
            Route::get("show/{id}", "show");
            Route::put("update/{id}", "update_category");
            Route::post("store", "store");
            Route::delete("delete/{id}", "delete");
        });
    });
    Route::controller(LocationController::class)->group(function () {
        Route::group(["prefix" => "location"], function () {
            Route::post("store", "store");
            Route::put("upload/{id} , 'update");
            Route::delete("destroy/{id}", "destory");
        });
    });
    Route::controller(ProductController::class)->group(function () {
        Route::group(["prefix" => "product"], function () {
            Route::get("index", "index");
            Route::get("show/{id}", "show");
            Route::put("update/{id}", "update_brand");
            Route::post("store", "store");
            Route::delete("destroy/{id}", "destroy");
        });
    });
    Route::controller(OrderController::class)->group(function () {
        Route::group(["prefix" => "order"], function () {
            Route::get("index", "index");
            Route::get("show/{id}", "show");
            Route::post("store", "store");
            Route::get("get_order_items/{id}", "get_order_items");
            Route::get("get_user_order/{id}", "get_user_order");
            Route::get("change_order_status/{id}", "change_order_status");
        });
    });
});


