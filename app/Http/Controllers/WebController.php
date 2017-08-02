<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Idioma;
use App\Portada;
use App\Ponente;
use App\TextosIdioma;
use App\Agenda;
use Session;
use Illuminate\Support\Facades\DB;
use URL;

class WebController extends Controller
{
    public function index()
    {
        //
    }

    public function ponentes()
    {
        $menus = Menu::get();
        $ponentes = Ponente::where('anio',date('Y'))->orderBy('orden')->get();
        //Breadcrums
        //Definimos el array con los elemento del breadcrum
        $elementos = ['Inicio','El Festival','Ponentes'];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        return view('web.ponentes', compact('menus','ponentes','breadcrums'));
    }

    public function programa()
    {
        $menus = Menu::get();
        return view('web.agenda', compact('menus'));
    }

    public function contacto()
    {
        $menus = Menu::get();
        return view('web.contacto',compact('menus'));
    }

    public function noticias()
    {
        return view('web.noticias');
    }

    public function detalle()
    {
        $slug = explode('/',$_SERVER["REQUEST_URI"])[count(explode('/',$_SERVER["REQUEST_URI"]))-1];
        $textosidioma = TextosIdioma::where('slug',$slug)->where('tipo_contenido_id',1)->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->first();
        //Definimos el array con los elemento del breadcrum
        $elementos = ['Inicio','El Festival',$textosidioma->titulo];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        $menus = Menu::get();
        return view('web.detalle',compact('menus','textosidioma','breadcrums'));
    }

    public function detalleponentes($slug)
    {
        $textosidioma = TextosIdioma::where('slug',$slug)->where('tipo_contenido_id',3)->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->first();
        $ponente = Ponente::findOrFail($textosidioma->contenido_id);
        //Definimos el array con los elemento del breadcrum
        $elementos = ['Inicio','El Festival','Ponentes',$textosidioma->titulo];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        $menus = Menu::get();

        return view('web.detalleponentes',compact('menus','ponente','textosidioma','breadcrums'));
    }

    public function devuelveBreadcrums(Array $elementos){
        //Breadcrums
        //Definimos un array para meter los componentes del breadcrum por orden
        $breadcrums = [];
        //Sacamos el slug (para componer el nombre de la ruta) y la etiqueta de la tabla de menus en el idioma correspondiente
        foreach($elementos as $elemento) {
            $ele_menu = Menu::where('label', $elemento)->first();
            if (is_object($ele_menu)) {
                $titulo = $elemento;
                $slug = '';
                if (!empty($ele_menu->content->textos_idioma)) {
                    $slug = str_replace('-','',$ele_menu->content->textos_idioma->slug);
                }
                $breadcrums[] = array($titulo, $slug);
            } else {
                //último nodo del breadcrum
                $breadcrums[] = array($elemento, null);
            }
        }
        return $breadcrums;
    }

}
