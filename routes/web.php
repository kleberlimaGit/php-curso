<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimesController;
use App\Http\Controllers\SeasonsController;

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

    Route::get('/', function () {
        return redirect('animes');
    });
    

    Route::controller(AnimesController::class)->group(function () {
        Route::get('/animes', 'index')->name('animes.index');
        Route::get('/animes/criar', 'create')->name('animes.create');
        Route::post('/animes/salvar', 'store')->name('animes.store');
        Route::post('/animes/excluir/{id}', 'destroy')->name('animes.destroy');
        Route::get('/animes/editar/{id}', 'edit')->name('animes.edit');
        Route::post('/animes/atualizar/{id}', 'update')->name('animes.update');
    });
    
    Route::get('animes/{seasons}/series', [SeasonsController::class, 'index'])->name('seasons.index');
    
//     Route::get('/animes', [AnimesController::class, 'index']);
//     Route::get('/animes/criar', [AnimesController::class, 'create']);
//     Route::post('/animes/salvar', [AnimesController::class, 'store']);

