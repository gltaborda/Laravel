<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\NoticiaController;

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


Auth::routes();

Route::get('/noticias/create', [NoticiaController::class, 'create'])
->name('noticias.create');

Route::post('/noticias', [NoticiaController::class, 'store'])
->name('noticias.store');

Route::get('/noticias', [NoticiaController::class, 'index'])
->name('noticias.index');

Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])
->name('noticias.show');

Route::get('/noticias/{noticia}/edit', [NoticiaController::class, 'edit'])
->name('noticias.edit');

Route::put('/noticias/{noticia}', [NoticiaController::class, 'update'])
->name('noticias.update');

Route::get('/noticias/{noticia}/delete', [NoticiaController::class, 'delete'])
    ->name('noticias.delete');

Route::delete('/noticias/{noticia}', [NoticiaController::class, 'destroy']);


Route::get('/contacto', [ContactoController::class, 'index'])
->name('contacto');

Route::post('/contacto', [ContactoController::class, 'send'])
->name('contacto.email');


Route::get('/', [WelcomeController::class, 'index'])
    ->name('portada');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
