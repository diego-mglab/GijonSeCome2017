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

use App\Menu;
use App\Idioma;
use App\Portada;
use App\Ponente;
use App\Content;
use Illuminate\Support\Facades\Session;
use App\Web;

//Rutas para los contenidos de la web


Route::get('/', function(){
   return redirect('/'.(Session::get('idioma') !== null?Session::get('idioma'):Idioma::where('principal',1)->first()->codigo));
})->name('principal');
$contents = Content::get();
$idiomas = Idioma::where('activado',1)->get();
$paginas_estaticas = [''];
foreach ($idiomas as $idioma){
    foreach($contents as $content) {
        if (is_object($content->textos_idioma_todos($idioma->id))) {
            //dd($content->textos_idioma_todos($idioma->id));
            if ($content->textos_idioma_todos($idioma->id)->visible == '1') {
                //echo $content->textos_idioma_todos($idioma->id)->visible;
                $parametros = '';
                if ($content->pagina_estatica != '1')
                    $metodo = str_replace("-", "", $content->textos_idioma_todos($idioma->id)->slug);
                else
                    $metodo = str_replace("-", "", $content->textos_idioma_todos(Idioma::where('principal', 1)->first()->id)->slug);
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
                    Route::get($codigo . '/' . $ruta . ($parametros != '' ? '/' . $parametros : ''), 'WebController@' . $metodo, function () {
                        //Session(['idioma' => $codigo]);
                        //App::SetLocale(Session::get('idioma'));
                        abort(404);
                    })->name(str_slug($content->textos_idioma_todos($idioma->id)->slug, "") . '_web_' . $codigo);
                    if ($content->textos_idioma_principal->slug == 'contacto') {
                        $metodo = 'contacto';
                        Route::post($codigo . '/' . $ruta . ($parametros != '' ? '/' . $parametros : ''), 'WebController@' . $metodo)
                            ->name(str_slug($content->textos_idioma_todos($idioma->id)->slug, "") . '_web_post_' . $codigo);
                    }
                    if ($content->textos_idioma_principal->slug == 'zona-de-prensa') {
                        $metodo = 'zonadeprensa';
                        Route::post($codigo . '/' . $ruta . ($parametros != '' ? '/' . $parametros : ''), 'WebController@' . $metodo)
                            ->name(str_slug($content->textos_idioma_todos($idioma->id)->slug, "") . '_web_post_' . $codigo);
                    }
                }
            }
        }
    }
    Route::get('/404','WebController@pag404')->name('pag404');
}

//Rutas para la página de la advertencia legal

Route::get('/es/advertencia-legal',function (){
    $menus = Menu::orderBy('order')->get();
    $portada = Portada::orderBy('orden')->get();
    $ponentes = Ponente::where('anio',date('Y'))->orderBy('orden')->get();
    //Metas
    $metas = Web::devuelveMetas('contents','',1);
    return view('web.advertencialegal',compact('menus','portada','ponentes','metas'));
});

Route::get('/as/alvertencia-llegal',function (){
    $menus = Menu::orderBy('order')->get();
    $portada = Portada::orderBy('orden')->get();
    $ponentes = Ponente::where('anio',date('Y'))->orderBy('orden')->get();
    //Metas
    $metas = Web::devuelveMetas('contents','',1);
    return view('web.advertencialegal',compact('menus','portada','ponentes','metas'));
});


//Rutas para los idiomas

Route::group(['middleware' => ['web']], function () {
    Route::get('{lang}', function ($lang) {
        Session(['idioma' => $lang]);
        App::SetLocale(Session::get('idioma'));
        $menus = Menu::orderBy('order')->get();
        $portada = Portada::orderBy('orden')->get();
        $ponentes = Ponente::where('anio',date('Y'))->orderBy('orden')->get();
        //Metas
        $metas = Web::devuelveMetas('contents','',1);
        return view('web.home',compact('menus','portada','ponentes','metas'));
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

    Route::get('usuarios/password', 'UserController@password');
    Route::post('usuarios/updatepassword', 'UserController@updatePassword');

    Route::resource('/usuarios', 'UserController');

    Route::resource('/modulos', 'ModuloController');

    Route::post('/permisos/updatePermissionMatrix', 'PermissionController@updatePermissionMatrix')->name('permisos.updatePermissionMatrix');

    Route::get('/permisos/matrix/{id}', 'PermissionController@showPermissionMatrix');

    Route::resource('/permisos', 'PermissionController');

    Route::post('/roles/updateRoleMatrix', 'RolController@updateRoleMatrix')->name('roles.updateRoleMatrix');

    Route::get('/roles/matrix', 'RolController@showRoleMatrix');

    Route::resource('/roles', 'RolController');

    Route::resource('/contents', 'ContentController');

    Route::resource('/zonas', 'ZonaController');

    Route::resource('/ponentes', 'PonenteController');

    Route::resource('/agenda', 'AgendaController');

    Route::resource('/portada', 'PortadaController');

    Route::resource('/galerias', 'GaleriaController');

    Route::resource('/documentos_prensa','DocumentosPrensaController');

    Route::resource('/configuracion','ConfiguracionController');

    Route::get('/menu', 'MenuController@getIndex');

    // Showing the admin for the menu builder and updating the order of menu items
    Route::get('/menu', 'MenuController@getIndex');
    Route::post('/menu', 'MenuController@postIndex');

    Route::post('menu/new', 'MenuController@postNew');
    Route::post('menu/delete', 'MenuController@postDelete');

    Route::get('menu/edit/{id}', 'MenuController@getEdit');
    Route::post('menu/edit/{id}', 'MenuController@postEdit');

    //Menú Admin
    Route::get('/menu_admin', 'MenuAdminController@getIndex');
    Route::post('/menu_admin', 'MenuAdminController@postIndex');

    Route::post('menu_admin/new', 'MenuAdminController@postNew');
    Route::post('menu_admin/delete', 'MenuAdminController@postDelete');

    Route::get('menu_admin/edit/{id}', 'MenuAdminController@getEdit');
    Route::post('menu_admin/edit/{id}', 'MenuAdminController@postEdit');

    Route::post('galerias/{galeria}/updateOrder','GaleriaController@updateOrder');

    Route::post('galerias/{galeria}/updateTextoImagen','GaleriaController@updateTextoImagen');
});
