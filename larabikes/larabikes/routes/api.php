<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BikeApiController;

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

Route::get('/motos', [BikeApiController::class, 'index']);

Route::get('/moto/{bike}', [BikeApiController::class, 'show'])
    ->where('bike', '^\d+$');

Route::get('/moto/{campo}/{valor}', [BikeApiController::class, 'search'])
    ->where('campo', '^marca|modelo|matricula$');

Route::post('/moto', [BikeApiController::class, 'store']);

Route::put('/moto/{bike}', [BikeApiController::class, 'update']);

Route::delete('/moto/{bike}', [BikeApiController::class, 'delete']);

Route::fallback(function(){
    return response(['status' => 'BAD REQUEST'], 400);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
