<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\AdminController;

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

Route::prefix('admin')->middleware('auth', 'is_admin')->group(function(){
    
    // motos eliminadas
    Route::get('deletedbikes', [AdminController::class, 'deletedBikes'])
    ->name('admin.deleted.bikes');
    
    // detalles de un usuario
    Route::get('usuario/{user}/detalles', [AdminController::class, 'userShow'])
    ->name('admin.user.show');
    
    // listado de usuarios
    Route::get('usuarios', [AdminController::class, 'userList'])
    ->name('admin.users');
    
    // búsqueda de usuarios
    Route::get('usuario/buscar', [AdminController::class, 'userSearch'])
    ->name('admin.users.search');
    
    // añadir rol
    Route::post('role', [AdminController::class, 'setRole'])
    ->name('admin.user.setRole');
    
    // quitar rol
    Route::delete('role', [AdminController::class, 'removeRole'])
    ->name('admin.user.removeRole');
    
});
    
Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



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

