<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\WelcomeController;
use Database\Factories\InstrumentFactory;

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

Route::get('/', [WelcomeController::class, 'index'])
    ->name('portada');

// Route::get('/instruments/create', [InstrumentController::class, 'create']);
// Route::post('/instruments', [InstrumentController::class, 'store']);

// Route::get('/instruments', [InstrumentController::class, 'index']);
// Route::get('/instruments/{instrument}', [InstrumentController::class, 'show']);

// Route::get('/instruments/{instrument}/edit', [InstrumentController::class, 'edit']);
// Route::put('/instruments/{instrument}', [InstrumentController::class, 'update']);

Route::get('instruments/search/{categoria?}/{marca?}/{modelo?}',
    [InstrumentController::class, 'search'])->name('instruments.search');

Route::resource('/instruments', InstrumentController::class);
    
Route::get('/instruments/{instrument}/delete', [InstrumentController::class, 'delete'])
    ->name('instruments.delete');
// Route::delete('/instruments/{instrument}', [InstrumentController::class, 'destroy']);

Route::fallback([WelcomeController::class, 'index']);