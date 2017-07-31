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
        $ponentes = Ponente::orderBy('orden')->get();
        return view('web.ponentes', compact('menus','ponentes'));
    }

    public function agenda()
    {
        $menus = Menu::get();
        return view('web.agenda', compact('menus'));
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
