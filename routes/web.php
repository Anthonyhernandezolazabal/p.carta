<?php

use App\Http\Controllers\NavegationController;
use App\Http\Controllers\SliderController;
use App\Models\Navegation;
use Illuminate\Support\Facades\Route;
use App\Models\Slider;
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

// Route::get('/', function () {
//     return view('web');
// });


Route::get('/', function(){
    $header = Slider::where('estado','=',1)->get();

    //MENÚ
    $navegacionMenu = Navegation::where('tipo','=','menu', 'and', 'estado', '=', 1)->first();
    if(!empty($navegacionMenu)){
        $arrMenu=json_decode($navegacionMenu["nombre"],TRUE);
        $arrMenuNombres = $arrMenu[0]["nombres"];
    }else{
        $arrMenuNombres = 0;
    }

    //LOGO
    $navegacionLogo = Navegation::where('tipo','=','logo', 'and', 'estado', '=', 1)->first();
    if(!empty($navegacionLogo)){
        $arrLogo=json_decode($navegacionLogo["nombre"],TRUE);
        $arrLogoNombres = $arrLogo[0]["nombres"];
    }else{
        $arrLogoNombres = 0;
    }

    return view('web',compact('header','arrMenuNombres','arrLogoNombres'));
});

// Route::get('/{any}', function () {
//     return view('layouts.home');
// })->name('basepath')
// ->where('any','.*');

Auth::routes();


//CONFIGURACIONES
Route::get('/navegation/getListaMenus', [NavegationController::class, 'getListaMenus']);
Route::post('/navegation/addMenus', [NavegationController::class, 'addMenus']);

Route::get('/navegation/getMostrarLogo', [NavegationController::class, 'getMostrarLogo']);
Route::post('/navegation/addLogo', [NavegationController::class, 'addLogo']);


//SLIDERS
Route::post('/slider/setRegistrarSlider', [SliderController::class, 'setRegistrarSlider']);
Route::get('/slider/getListarSlider', [SliderController::class, 'getListarSlider']);
Route::delete('/slider/delSlider/{id}', [SliderController::class, 'delSlider']);
Route::post('/slider/delImgSlider/{id}', [SliderController::class, 'delImgSlider']);
Route::get('/slider/showEditSlider/{id}', [SliderController::class, 'showEditSlider']);
Route::post('/slider/editSlider', [SliderController::class, 'editSlider']);
Route::post('/slider/cambiarEstadoView', [SliderController::class, 'cambiarEstadoView']);




Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
