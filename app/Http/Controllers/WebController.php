<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Idioma;
use App\Portada;
use App\Ponente;
use App\TextosIdioma;
use Session;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    {
        if (Session::get('idioma') === null) {
            $idioma = Idioma::where('principal','1')->first();
            Session::put('idioma',$idioma->id);
        }
        $menus = Menu::get();
        $portada = Portada::orderBy('orden')->get();
        $ponentes = Ponente::orderBy('orden')->get();
        $idioma_principal = Idioma::where('principal','1')->first()->id;
        return view('web.home',compact('menus','portada','ponentes','idioma_principal'));
    }

    public function ponentes()
    {
        return view('web.ponentes');
    }

    public function agenda()
    {
        return view('web.agenda');
    }

    public function contacto()
    {
        return view('web.contacto');
    }

    public function noticias()
    {
        return view('web.noticias');
    }

    public function detalle()
    {
        return view('web.detalle');
    }

    public function detalleponentes()
    {
        return view('web.detalleponentes');
    }
}
