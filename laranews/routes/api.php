<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoticiaApiController;

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

Route::get('/noticias', [NoticiaApiController::class, 'index']);

Route::get('/noticia/{noticia}', [NoticiaApiController::class, 'show'])
->where('noticia', '^\d+$');

Route::get('/noticia/{campo}/{valor}', [NoticiaApiController::class, 'search'])
->where('campo', '^titulo|texto|tema$');

Route::post('/noticia', [NoticiaApiController::class, 'store']);

Route::put('/noticia/{noticia}', [NoticiaApiController::class, 'update']);

Route::delete('/noticia/{noticia}', [NoticiaApiController::class, 'delete']);

Route::fallback(function(){
    return response(['status' => 'BAD REQUEST'], 400);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
