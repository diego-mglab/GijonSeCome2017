<?php

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
//Route::get('/', function () {
//    return view('welcome');
//});

//Rutas para web

Route::get('/', 'WebController@index')->name('home_web');
Route::get('/ponentes', 'WebController@ponentes')->name('ponentes_web');
Route::get('/agenda', 'WebController@agenda')->name('agenda_web');
Route::get('/contacto', 'WebController@contacto')->name('contacto_web');
Route::get('/noticias', 'WebController@noticias')->name('noticias_web');
Route::get('/detallenoticias', 'WebController@detallenoticias')->name('detalle_noticias_web');
Route::get('/detalleponentes', 'WebController@detalleponentes')->name('detalle_ponentes_web');


//Rutas para gestor de contenido

Auth::routes();

Route::group(['prefix' => 'eunomia' , 'middleware' => 'auth' ], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/idiomas', 'IdiomaController');

    Route::resource('/usuarios', 'UserController');

    Route::resource('/contents', 'ContentController');

    Route::resource('/zonas', 'ZonaController');

    Route::resource('/ponentes', 'PonenteController');

});