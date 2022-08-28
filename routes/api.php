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



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     //return $request->user();
    
//     die("lolll");
// });

Route::post('get_user_info',[App\Http\Controllers\ApiController::class,'get_user_info']);
Route::post('add_customer',[App\Http\Controllers\ApiController::class,'add_customer']);
Route::get('get_items',[App\Http\Controllers\ApiController::class,'get_item']);
Route::post('get_wallet',[App\Http\Controllers\ApiController::class,'get_wallet']);
Route::post('place_order',[App\Http\Controllers\ApiController::class,'place_order']);
Route::post('get_order_history',[App\Http\Controllers\ApiController::class,'get_order_history']);


//Rider App API
Route::post('get_rider_info',[App\Http\Controllers\ApiController::class,'get_rider_info']);
Route::post('get_rider_orders',[App\Http\Controllers\ApiController::class,'get_rider_orders']);
Route::post('get_rider_order_detail',[App\Http\Controllers\ApiController::class,'get_rider_order_detail']);
Route::post('process_order',[App\Http\Controllers\ApiController::class,'process_order']);
Route::post('complete_order',[App\Http\Controllers\ApiController::class,'complete_order']);

Route::post('generate_otp_code',[App\Http\Controllers\ApiController::class,'generate_otp_code']);



