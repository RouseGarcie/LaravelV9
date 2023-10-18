<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


 //   Route::get('/{slug}', [\App\Http\Controllers\ProductosController::class, 'editar'])->name('editar');
    Route::get('/editar/{id}', [\App\Http\Controllers\ProductosController::class, 'editar'])->name('editar');


});

require __DIR__.'/auth.php';
