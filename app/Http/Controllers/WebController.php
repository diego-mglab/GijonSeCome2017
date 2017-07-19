<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function index()
    {
        return view('web.home
        ');
    }

    public function ponentes()
    {
        return view('web.ponentes
        ');
    }

    public function agenda()
    {
        return view('web.agenda
        ');
    }

    public function contacto()
    {
        return view('web.contacto
        ');
    }

    public function noticias()
    {
        return view('web.noticias
        ');
    }

    public function detalle()
    {
        return view('web.detalle
        ');
    }

    public function detalleponentes()
    {
        return view('web.detalleponentes
        ');
    }
}
