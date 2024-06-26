<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;
use App\Models\Bike;

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
    return 'Hola Mundo! :D';
});
    

// FIN DE LA ZONA PARA PRUEBAS



    
    
Route::get('/', [WelcomeController::class, 'index'])
    ->name('portada');

Route::get('bikes/search/{marca?}/{modelo?}', [BikeController::class, 'search'])
->name('bikes.search');

Route::resource('bikes',BikeController::class);

Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])
->name('bikes.delete');

Route::delete('/bikes/{bike}', [Bikecontroller::class, 'destroy'])
->name('bikes.destroy')->middleware('signed');



Route::fallback([WelcomeController::class, 'index']);