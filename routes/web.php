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

use App\Menu;
use App\Idioma;
use App\Portada;
use App\Ponente;

//Rutas para web


Route::get('/', function(){
   return redirect('/'.Session::get('idioma') !== null?Session::get('idioma'):Idioma::where('principal',1)->first()->codigo);
})->name('principal');
$idiomas = Idioma::all();
foreach ($idiomas as $idioma){
    $codigo = $idioma->codigo;
    Route::get($codigo.'/ponentes', 'WebController@ponentes')->name('ponentes_web_'.$codigo);
    Route::get($codigo.'/agenda', 'WebController@agenda')->name('agenda_web_'.$codigo);
    Route::get($codigo.'/detalleponentes/{slug}', 'WebController@detalleponentes')->name('detalleponentes_web_'.$codigo);
}
Route::get('/contacto', 'WebController@contacto')->name('contacto_web');
Route::get('/noticias', 'WebController@noticias')->name('noticias_web');
Route::get('/detalle', 'WebController@detalle')->name('detalle_web');
Route::get('/nuestra-filosofia', 'WebController@detalleponentes')->name('nuestra-filosofia');
Route::get('/el-festival', 'WebController@detalleponentes')->name('el-festival');
Route::get('/gijonsecome-es-sostenible', 'WebController@detalleponentes')->name('gijonsecome-es-sostenible');
Route::get('/primera-edidion', 'WebController@detalleponentes')->name('primera-edidion');
Route::get('/ponentes', 'WebController@ponentes')->name('ponentes');
Route::get('/programa', 'WebController@detalleponentes')->name('programa');
Route::get('/zona-de-prensa', 'WebController@detalleponentes')->name('zona-de-prensa');
Route::get('/hemeroteca', 'WebController@detalleponentes')->name('hemeroteca');
Route::get('/contacto', 'WebController@contacto')->name('contacto');

Route::group(['middleware' => ['web']], function () {
    Route::get('{lang}', function ($lang) {
        Session(['idioma' => $lang]);
        App::SetLocale(Session::get('idioma'));
        $menus = Menu::get();
        $portada = Portada::orderBy('orden')->get();
        $ponentes = Ponente::where('anio',date('Y')-1)->orderBy('orden')->get();
        return view('web.home',compact('menus','portada','ponentes'));
    })->where([
        'lang' => 'es|as'
    ]);
});

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

    Route::resource('/agenda', 'AgendaController');

    Route::resource('/portada', 'PortadaController');

    Route::resource('/galerias', 'GaleriaController');

    Route::get('/menu', 'MenuController@getIndex');

    // Showing the admin for the menu builder and updating the order of menu items
    Route::get('/menu', 'MenuController@getIndex');
    Route::post('/menu', 'MenuController@postIndex');

    Route::post('menu/new', 'MenuController@postNew');
    Route::post('menu/delete', 'MenuController@postDelete');

    Route::get('menu/edit/{id}', 'MenuController@getEdit');
    Route::post('menu/edit/{id}', 'MenuController@postEdit');

});