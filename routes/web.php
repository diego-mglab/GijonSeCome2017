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
use App\Content;
use Illuminate\Support\Facades\Session;


//Rutas para web


Route::get('/', function(){
   return redirect('/'.(Session::get('idioma') !== null?Session::get('idioma'):Idioma::where('principal',1)->first()->codigo));
})->name('principal');
$contents = Content::get();
$idiomas = Idioma::where('activado',1)->get();
$paginas_estaticas = [''];
foreach ($idiomas as $idioma){
    foreach($contents as $content) {
        if (is_object($content->textos_idioma_todos($idioma->id))) {
            $parametros = '';
            $metodo = str_replace("-", "", $content->textos_idioma_todos($idioma->id)->slug);
            $ruta = $content->textos_idioma_todos($idioma->id)->slug;
            if ($content->textos_idioma_principal->slug == 'detalle-ponentes')
                $parametros = '{slug}';
            if ($content->textos_idioma_principal->slug == 'ponentes' || $content->textos_idioma_principal->slug == 'galeria')
                $parametros = '{anio?}';
            if ($content->pagina_estatica == 0) {
                $metodo = 'detalle';
            }
            $codigo = Idioma::where('id', $content->textos_idioma_todos($idioma->id)->idioma_id)->first()->codigo;
            if ($content->id == 1)
                Route::get($codigo . '/' . $content->textos_idioma_todos($idioma->id)->slug, function () {
                    return redirect('/' . (Session::get('idioma') !== null ? Session::get('idioma') : Idioma::where('principal', 1)->first()->codigo));
                })->name($content->textos_idioma_todos($idioma->id)->slug . '_web_' . $codigo);
            elseif ($metodo != '') {
                Route::get($codigo . '/' . $ruta . ($parametros != '' ? '/' . $parametros : ''), 'WebController@' . $metodo, function(){
                    Session(['idioma' => $codigo]);
                    App::SetLocale(Session::get('idioma'));
                })->name(str_slug($content->textos_idioma_todos($idioma->id)->slug, "") . '_web_' . $codigo);
                if ($content->textos_idioma_principal->slug == 'contacto'){
                    $metodo = 'contacto';
                    Route::post($codigo . '/' . $ruta . ($parametros != '' ? '/' . $parametros : ''), 'WebController@' . $metodo)
                        ->name(str_slug($content->textos_idioma_todos($idioma->id)->slug, "") . '_web_post_' . $codigo);
                }
            }
        }

    }
}


Route::group(['middleware' => ['web']], function () {
    Route::get('{lang}', function ($lang) {
        Session(['idioma' => $lang]);
        App::SetLocale(Session::get('idioma'));
        $menus = Menu::get();
        $portada = Portada::orderBy('orden')->get();
        $ponentes = Ponente::where('anio',date('Y'))->orderBy('orden')->get();
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

    Route::post('galerias/{galeria}/updateOrder','GaleriaController@updateOrder');

});