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

Route::get('/', 'WebController@index')->name('index');


//Rutas para gestor de contenido

Auth::routes();

Route::group(['prefix' => 'eunomia' , 'middleware' => 'auth' ], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('/idiomas', 'IdiomaController');

    Route::resource('/usuarios', 'UserController');

    Route::resource('/contents', 'ContentController');

});