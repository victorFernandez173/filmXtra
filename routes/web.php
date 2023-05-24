<?php

use App\Http\Controllers\FiltrarObrasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\ProviderController;
use Inertia\Inertia;
use App\Http\Controllers\BienvenidaController;
use App\Http\Controllers\ObtenerObraController;
use App\Http\Controllers\LikeController;


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


Route::get('/', [BienvenidaController::class, 'bienvenida'])->name('/');

Route::get('obra/{titulo}', [ObtenerObraController::class, 'fichaPelicula'])->name('obra');

Route::get('/obras', [FiltrarObrasController::class, 'cargaDatos'])->name('obras');

Route::post('/like', [LikeController::class, 'darLike'])->name('darLike');

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect'])->name('redirect');
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback'])->name('callback');

/*Route::get('/auth/github/redirect', [ProviderController::class, 'redirect'])->name('redirect');
Route::get('/auth/github/callback', [ProviderController::class, 'callback'])->name('callback');*/

/*Route::get('/logueado', [MainController::class, 'logueado'])
->middleware('auth', 'verified')->name('logueado');*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
