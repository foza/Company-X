<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/product/byId', [ApiController::class,'getProduct']);
Route::post('/product/all', [ApiController::class,'getAllProduct']);

Route::post('/category/byId', [ApiController::class,'getCategory']);
Route::post('/category/all', [ApiController::class,'getAllCategory']);
