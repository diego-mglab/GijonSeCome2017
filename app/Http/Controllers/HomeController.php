<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Content;
use App\Ponente;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $noticias = Content::where('tipo_contenido','noticia')
            ->orderBy('fecha','DESC')->take(5)->get();
        $entrevistas = Content::where('tipo_contenido','entrevista')
            ->OrderBy('fecha','DESC')->take(5)->get();
        $ponentes = Ponente::where('anio',date('Y'))
            ->orderBy('orden','ASC')->take(5)->get();
        $todas_noticias = Content::where('tipo_contenido','noticia')->get();
        $todas_entrevistas = Content::where('tipo_contenido','entrevista')->get();
        $todos_ponentes = Ponente::where('anio',date('Y'))->get();
        return view('home',compact('users','noticias','entrevistas','ponentes','todas_noticias','todas_entrevistas','todos_ponentes'));
    }
}
