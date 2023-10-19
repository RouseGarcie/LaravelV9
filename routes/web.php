<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Sluggable\SlugOptions;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', [\App\Http\Controllers\ProductosController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cambiar/idioma', [\App\Http\Controllers\SistemaGeneralController::class, 'cambiarIdioma'])->name('cambiarIdioma');


    Route::get('/agregar', [\App\Http\Controllers\ProductosController::class, 'agregar'])->name('agregar');
    Route::post('/producto/guardar', [\App\Http\Controllers\ProductosController::class, 'guardar'])->name('guardar');

    Route::post('/conversionMonedaPesos', [\App\Http\Controllers\ProductosController::class, 'conversionPesos'])->name('conversionPesos');
    Route::post('/conversionMonedaDolar', [\App\Http\Controllers\ProductosController::class, 'conversionDolar'])->name('conversionDolar');


    Route::get('/{slug}', [\App\Http\Controllers\ProductosController::class, 'obtenerDetalle'])->name('obtenerDetalle');
    Route::get('/editar/{id}', [\App\Http\Controllers\ProductosController::class, 'editar'])->name('editar');
    Route::post('/producto/guardarEdicion', [\App\Http\Controllers\ProductosController::class, 'guardarEdicion'])->name('guardarEdicion');
  //  Route::get('/{slug}', 'ProductosController')->name('home.post');

    Route::put('/inactivar', [\App\Http\Controllers\ProductosController::class, 'inactivar'])->name('inactivar');
    Route::put('/eliminar', [\App\Http\Controllers\ProductosController::class, 'eliminar'])->name('eliminar');



});

require __DIR__.'/auth.php';


Route::get('/detalleProducto', [\App\Http\Controllers\ProductosController::class, 'detalleProducto'])->name('detalleProducto');
