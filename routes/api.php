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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/product/addProduct', 'ProductController@store');
Route::post('/product/addToCart', 'ProductController@addToCart');
Route::get('/product/All', 'ProductController@show');
Route::get('/product/{id}', 'ProductController@findById');
Route::get('/order', 'OrderController@show');