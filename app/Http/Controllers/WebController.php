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
use App\Content;
use App\Galeria;
use App\Multimedia;
use Session;
use Illuminate\Support\Facades\DB;
use URL;
use Redirect;
use Carbon\Carbon;
use Mail;

class WebController extends Controller
{
    public function index()
    {
        //
    }

    public function ponentes($anio=2017)
    {
        //dd(Session::all());
        $menus = Menu::orderBy('order')->get();
        $ponentes = Ponente::where('anio',$anio)->orderBy('orden')->get();
        //Breadcrums
        //Definimos el array con los elemento del breadcrum
        $elementos = ['Inicio','El Festival','Ponentes'];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        return view('web.ponentes', compact('menus','ponentes','breadcrums','anio'));
    }

    public function programa()
    {
        $menus = Menu::orderBy('order')->get();
        return view('web.agenda', compact('menus'));
    }

    public function galeria($anio=2017)
    {
        $menus = Menu::orderBy('order')->get();
        $galeria = Galeria::where('anio',$anio)->orderBy('orden')->first();
        if (is_object($galeria))
            $multimedia = Multimedia::where('galeria_id',$galeria->id)->orderBy('orden')->get();
        //Breadcrums
        //Definimos el array con los elemento del breadcrum
        $elementos = ['Inicio','El Festival','Galería'];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        return view('web.galeria', compact('menus','breadcrums','anio','galeria','multimedia'));
    }

    public function contacto(Request $request)
    {
        if ($request->nombre != ''){
            $email = '';
            switch($request->tipo_contacto){
                case 'Expositores' || 'Patrocinadores':
                    $email = 'info@gijonsecome.es';
                    break;
                case 'Prensa':
                    $email = 'prensa@gijonsecome.es';
                    break;
                case 'Programación del festival':
                    $email = 'programacion@gijonsecome.es';
                    break;
            }
            $email = 'diego@mglab.es';
            Mail::send('web.includes.contacta', $request->all(), function($msj){
            $msj->subject('Formulario contacto web GijonSeCome');
            $msj->to('diego@mglab.es');
            });
        }
        $menus = Menu::orderBy('order')->get();
        return view('web.contacto',compact('menus'));
    }

    public function noticias()
    {
        $menus = Menu::orderBy('order')->get();
        $noticias = Content::where('tipo_contenido','noticia')->where('fecha_publicacion','<=',date('Y-m-d'))->get();
        //Definimos el array con los elemento del breadcrum
        $elementos = ['Inicio','El Festival','Noticias'];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        return view('web.noticias',compact('menus','noticias','breadcrums'));
    }

    public function detalle()
    {
        $slug = explode('/',$_SERVER["REQUEST_URI"])[count(explode('/',$_SERVER["REQUEST_URI"]))-1];
        $textosidioma = TextosIdioma::where('slug',$slug)->where('tipo_contenido_id',1)->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->first();
        if ($textosidioma->contenido_id > 0)
            $content = Content::findOrFail($textosidioma->contenido_id);
        else
            return Redirect::to('/');
        $menus = Menu::orderBy('order')->get();
        //Devolvemos los tres últimos registros salvo este para pintarlos al final de la página detalle
        if ($content->tipo_contenido == 'noticia' || $content->tipo_contenido == 'entrevista')
            $registros = DB::table('contents')
                ->join('textos_idiomas','contents.id','textos_idiomas.contenido_id')
                ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
                ->select('titulo','subtitulo','contents.imagen','slug')
                ->where('textos_idiomas.visible','1')
                ->where('tipo_contenido_id','1')
                //->where('fecha_publicacion','<=',date('Y-m-d'))
                ->where('contents.id','<>',$content->id)
                ->where('tipo_contenido',$content->tipo_contenido)
                ->orderBy('fecha_publicacion','DESC')
                ->limit(3)->get();
        else
            $registros = null;
        //Comprobamos que el contenido esté dentro de la fecha de publicación (fecha actual >= fecha publicación
        $now = Carbon::now();
        $fecha_publicacion = Carbon::parse($content->fecha_publicacion);
        if ($now->gte($fecha_publicacion)) {
            //Definimos el array con los elemento del breadcrum
            $elementos = ['Inicio', 'El Festival', $textosidioma->titulo];
            $breadcrums = $this->devuelveBreadcrums($elementos);
            return view('web.detalle', compact('menus', 'textosidioma', 'breadcrums', 'content','registros'));
        } else {
            return redirect('/');
        }
    }

    public function agenda()
    {
        $menus = Menu::orderBy('order')->get();
        $agenda = Agenda::orderBy('fecha')->orderBy('hora')->get();
        //Definimos el array con los elemento del breadcrum
        $elementos = ['Inicio','El Festival','Programa'];
        $dias_evento = ['Sábado','Domingo','Lunes'];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        return view('web.agenda',compact('menus','agenda','breadcrums','dias_evento'));
    }

    public function detalleponentes($slug)
    {
        $textosidioma = TextosIdioma::where('slug',$slug)->where('tipo_contenido_id',3)->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->first();
        $ponente = Ponente::findOrFail($textosidioma->contenido_id);
        $agenda = DB::table('ponentes_agenda')
            ->join('agenda','ponentes_agenda.agenda_id','agenda.id')
            ->join('textos_idiomas','agenda.id','textos_idiomas.contenido_id')
            ->join('zonas','agenda.zona_id','zonas.id')
            ->where('textos_idiomas.tipo_contenido_id','2')
            ->where('ponentes_agenda.ponentes_id',$ponente->id)
            ->OrderBy('agenda.fecha')->OrderBy('agenda.hora')->get();
        //Definimos el array con los elemento del breadcrum
        $elementos = ['Inicio','El Festival','Ponentes',$textosidioma->titulo];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        $menus = Menu::orderBy('order')->get();

        return view('web.detalleponentes',compact('menus','ponente','textosidioma','breadcrums','agenda'));
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
