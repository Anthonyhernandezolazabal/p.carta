<?php

use App\Http\Controllers\FooterController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NavegationController;
use App\Http\Controllers\SliderController;
use App\Models\Footer;
use App\Models\Navegation;
use App\Models\Menu;
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
    //SLIDER
    $header = Slider::where('estado','=',1)->get();
    //NAVEGACIÓN
    $navegacionMenu = Navegation::where('tipo','=','menu', 'and', 'estado', '=', 1)->first();
    $arrMenuNombres = (!empty($navegacionMenu)) ? json_decode($navegacionMenu["nombre"],TRUE)[0]["nombres"] : 0;
    //LOGO
    $navegacionLogo = Navegation::where('tipo','=','logo', 'and', 'estado', '=', 1)->first();
    $arrLogoNombres = (!empty($navegacionLogo)) ? json_decode($navegacionLogo["nombre"],TRUE)[0]["nombres"] : 0;
    //MENU01
    $menu01 = Menu::where('tipo','=','Menu01')->first();
    $arrMenu01 = (!empty($menu01)) ? json_decode($menu01["estructura"],TRUE) : 0;
    //MENU02
    $menu02 = Menu::where('tipo','=','Menu02')->first();
    $arrMenu02 = (!empty($menu02)) ? json_decode($menu02["estructura"],TRUE) : 0;
    //FOOTER
    $footer = Footer::where('tipo','=','Footer')->first();
    $arrFooter = (!empty($footer)) ? json_decode($footer["estructura"],TRUE) : 0;

    return view('web',compact('header','arrMenuNombres','arrLogoNombres','arrMenu01','arrMenu02','arrFooter'));
});

// Route::get('/{any}', function () {
//     return view('layouts.home');
// })->name('basepath')
// ->where('any','.*');

Auth::routes();


//MOSTRAR DATOS EN SIDEBAR
Route::get('/navegation/sbMenu', [NavegationController::class, 'sbMenu']);

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

//MENU01
Route::post('/menus/setRegistrarMenu01', [MenuController::class, 'setRegistrarMenu01']);
Route::get('/menus/getListarMenus/{tipo}', [MenuController::class, 'getListarMenus']);
//MENU02
Route::post('/menus/setRegistrarImagenMenu02', [MenuController::class, 'setRegistrarImagenMenu02']);
Route::post('/menus/setRegistrarSectionMenu02', [MenuController::class, 'setRegistrarSectionMenu02']);
Route::get('/menus/getEditarEliminarCarta/{id}/{e}', [MenuController::class, 'getEditarEliminarCarta']);

//FOOTER
Route::post('/footer/setRegistrarFooter', [FooterController::class, 'setRegistrarFooter']);
Route::get('/footer/getListarFooter/{tipo}', [FooterController::class, 'getListarFooter']);
Route::get('/footer/getEditarEliminarFooter/{id}/{e}', [FooterController::class, 'getEditarEliminarFooter']);



Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
