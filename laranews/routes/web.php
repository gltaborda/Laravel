<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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
    /*Route::get('deletedNoticias', [AdminController::class, 'deletedNoticias'])
    ->name('admin.deleted.noticias');*/
    
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


Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::delete('/noticias/purge', [NoticiaController::class, 'purge'])
    ->name('noticias.purge');

Route::get('/noticias/{noticia}/restore', [NoticiaController::class, 'restore'])
    ->name('noticias.restore');

Route::get('/noticias/create', [NoticiaController::class, 'create'])
    ->name('noticias.create')->middleware('auth', 'is_redactor');

Route::post('/noticias', [NoticiaController::class, 'store'])
    ->name('noticias.store');

Route::get('/noticias', [NoticiaController::class, 'index'])
    ->name('noticias.index')->middleware('auth', 'is_editor');;

    
Route::get('/noticias/{noticia}/approve', [NoticiaController::class, 'approve'])
    ->name('noticias.approve')->middleware('auth', 'is_editor');
    
Route::get('/noticias/{noticia}/reject', [NoticiaController::class, 'reject'])
    ->name('noticias.reject')->middleware('auth', 'is_editor');


    
Route::get('noticias/search/{titulo?}/{tema?}', [NoticiaController::class, 'search'])
    ->name('noticias.search');

    
Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])
    ->name('noticias.show');
   
Route::get('/noticias/{noticia}/edit', [NoticiaController::class, 'edit'])
    ->name('noticias.edit');

Route::put('/noticias/{noticia}', [NoticiaController::class, 'update'])
    ->name('noticias.update');

Route::get('/noticias/{noticia}/delete', [NoticiaController::class, 'delete'])
    ->name('noticias.delete');

Route::delete('/noticias/{noticia}', [NoticiaController::class, 'destroy'])
    ->name('noticias.destroy')->middleware('signed');

    
Route::get('/contacto', [ContactoController::class, 'index'])
    ->name('contacto');

Route::post('/contacto', [ContactoController::class, 'send'])
    ->name('contacto.email');

    
Route::post('/comentarios', [ComentarioController::class, 'store'])
    ->name('comentarios.store');

Route::delete('/comentarios', [ComentarioController::class, 'delete'])
    ->name('comentarios.delete');

Route::get('/bloqueado', [UserController::class, 'blocked'])
    ->name('user.blocked');  
    
    
Route::get('/', [WelcomeController::class, 'index'])
    ->name('portada');

Route::fallback([WelcomeController::class, 'index']);