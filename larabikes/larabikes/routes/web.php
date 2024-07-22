<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


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

// ZONA PARA PRUEBAS (borrar al finalizar)


/*Route::get(
    'bikes/search/{marca?}/{modelo?}',
    function($marca = '', $modelo = ''){
    
        //busca las motos con esa marca y modelo
        $bikes = Bike::where('marca', 'like', '%'.$marca.'%')
            ->where('modelo', 'like', '%'.$modelo.'%')
            ->paginate(config('pagination.bikes'));
        
        return view('bikes.list', ['bikes' => $bikes]);
        
});*/



    
Route::get('saludar', function(){
    return response()->file(storage_path('/memes/travolta.gif'),
    ['Content-type' => 'image/gif']);
});



// FIN DE LA ZONA PARA PRUEBAS

Route::get('/bloqueado', [UserController::class, 'blocked'])
    ->name('user.blocked');     

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

Route::delete('/bikes/purge', [BikeController::class, 'purge'])
    ->name('bikes.purge');

Route::get('/bikes/{bike}/restore', [BikeController::class, 'restore'])
    ->name('bikes.restore');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contacto', [ContactoController::class, 'index'])
    ->name('contacto');

Route::post('/contacto', [ContactoController::class, 'send'])
    ->name('contacto.email');

    
Route::get('/bikes/editlast', [BikeController::class, 'editLast'])
    ->name('bikes.editlast');

Route::get('/', [WelcomeController::class, 'index'])
    ->name('portada');

Route::get('bikes/search/{marca?}/{modelo?}', [BikeController::class, 'search'])
    ->name('bikes.search');

Route::resource('bikes',BikeController::class);

Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])
    ->name('bikes.delete');

Route::delete('/bikes/{bike}', [BikeController::class, 'destroy'])
    ->name('bikes.destroy')->middleware('signed');

Route::fallback([WelcomeController::class, 'index']);






