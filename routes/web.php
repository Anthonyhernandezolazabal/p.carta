<?php

use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

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
    return view('web');
});

// Route::get('/{any}', function () {
//     return view('layouts.home');
// })->name('basepath')
// ->where('any','.*');

Auth::routes();

Route::post('/slider/setRegistrarSlider', [SliderController::class, 'setRegistrarSlider']);
Route::get('/slider/getListarSlider', [SliderController::class, 'getListarSlider']);
Route::delete('/slider/delSlider/{id}', [SliderController::class, 'delSlider']);
Route::post('/slider/delImgSlider/{id}', [SliderController::class, 'delImgSlider']);
Route::get('/slider/showEditSlider/{id}', [SliderController::class, 'showEditSlider']);

Route::post('/slider/editSlider', [SliderController::class, 'editSlider']);
Route::post('/slider/cambiarEstadoView', [SliderController::class, 'cambiarEstadoView']);

Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');