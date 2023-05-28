<?php

use App\Http\Controllers\CriticaController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\FichaValoracionController;
use App\Http\Controllers\TopObrasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopValoracionesController;
use App\Http\Controllers\BienvenidaController;
use App\Http\Controllers\ObtenerObraController;
use App\Http\Controllers\LikeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [BienvenidaController::class, 'bienvenida'])->name('/');

Route::get('obra/{titulo}', [ObtenerObraController::class, 'fichaPelicula'])->name('obra');

Route::get('top', [TopObrasController::class, 'cargarDatos'])->name('top');

Route::get('valoraciones', [TopValoracionesController::class, 'cargarDatos'])->name('valoraciones');

Route::get('valoraciones/{titulo}', [FichaValoracionController::class, 'obtenerFichaValoracion'])->name('fichaValoraciones');

Route::post('/like', [LikeController::class, 'darLike'])->name('darLike');

Route::post('evaluar', [EvaluacionController::class, 'evaluar'])->name('evaluar');

Route::post('criticar', [CriticaController::class, 'criticar'])->name('criticar');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
