<?php

namespace App\Http\Controllers;

use App\Web;
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
use Illuminate\View\View;
use Session;
use Illuminate\Support\Facades\DB;
use URL;
use Redirect;
use Carbon\Carbon;
use Mail;
use App;
use App\DocumentosPrensa;
use App\Configuracion;
use InvisibleReCaptcha;

class WebController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Muestra la página de error 404.
     *
     * @return View
     */
    public function pag404(){
        $menus = Menu::orderBy('order')->get();
        $portada = Portada::orderBy('orden')->get();
        $ponentes = Ponente::where('anio',date('Y'))->orderBy('orden')->get();
        //Metas
        $metas = Web::devuelveMetas('contents','',1);
        return view('errors.404',compact('menus','portada','ponentes','metas'));
    }

    /**
     * Muestra la página de los ponentes
     * Recibe el parámetro $anio para mostrar los ponentes correspondientes a cada año
     *
     * @param  int $anio
     * @return View
     */
    public function ponentes($anio=2017)
    {
        $this->estableceIdioma();
        $menus = Menu::orderBy('order')->get();
        $ponentes = Ponente::where('anio',$anio)->orderBy('orden')->get();
        //Metas
        $metas = Web::devuelveMetas('contents','ponentes',1);
        //Breadcrums
        //Definimos el array con los elemento del breadcrum
        $elementos = ['Inicio','El Festival','Ponentes'];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        return view('web.ponentes', compact('menus','ponentes','breadcrums','anio','metas'));
    }

    /**
     * Muestra la página del programa de eventos
     *
     * @return View
     */
    public function programa()
    {
        $this->estableceIdioma();
        $menus = Menu::orderBy('order')->get();
        return view('web.agenda', compact('menus'));
    }

    /**
     * Muestra la página de la galería de imágenes y videos
     * Recibe el parámetro $anio para mostrar la galería correspondiente a cada año
     *
     * @param  int $anio
     * @return View
     */
    public function galeria($anio=2017)
    {
        $this->estableceIdioma();
        $menus = Menu::orderBy('order')->get();
        $galeria = Galeria::where('anio',$anio)->orderBy('orden')->first();
        if (is_object($galeria))
            $multimedia = Multimedia::where('galeria_id',$galeria->id)->orderBy('orden')->get();
        //Metas
        $metas = Web::devuelveMetas('galerias','galeria',5);
        //Breadcrums
        //Definimos el array con los elemento del breadcrum
        $elementos = ['Inicio','El Festival','Galería'];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        return view('web.galeria', compact('menus','breadcrums','anio','galeria','multimedia','metas'));
    }

    /**
     * Muestra la página del contacto
     * Recibe el formulario para enviar el email con los datos del formulario
     *
     * @param  Request $request
     * @return View
     */
    public function contacto(Request $request)
    {
        if ($request->nombre != ''){
            $email = '';
            switch($request->tipo_contacto){
                case 'Expositores' || 'Patrocinadores':
                    $email = 'info@gijonsecome.es';
                    break;
                case 'Programación del festival':
                    $email = 'programacion@gijonsecome.es';
                    break;
            }
            Mail::send('web.includes.contacta', $request->all(), function($msj) use ($email){
                $msj->subject('Formulario contacto web GijonSeCome');
                $msj->to($email);
            });
        }
        $this->estableceIdioma();
        $ruta_formulario = Content::where('id',6)->first()->textos_idioma->slug;
        //Metas
        $metas = Web::devuelveMetas('contents','contacto',1);
        $menus = Menu::orderBy('order')->get();
        return view('web.contacto',compact('menus','metas','ruta_formulario'));
    }

    /**
     * Muestra la página de la zona de prensa
     * Recibe el formulario para enviar el email con los datos del formulario
     * Muestra tambien los documentos subidos en la gestión
     *
     * @param  Request $request
     * @return View
     */
    public function zonadeprensa(Request $request)
    {
        if ($request->nombre != ''){
            $email = 'prensa@gijonsecome.es';
            Mail::send('web.includes.zonadeprensa', $request->all(), function($msj) use ($email){
                $msj->subject('Formulario prensa web GijonSeCome');
                $msj->to($email);
            });
        }
        $this->estableceIdioma();
        $documentosPrensa = DocumentosPrensa::all();
        //Metas
        $metas = Web::devuelveMetas('contents','zona_prensa',1);
        $menus = Menu::orderBy('order')->get();
        return view('web.zonadeprensa',compact('menus','documentosPrensa','metas'));
    }

    /**
     * Muestra la página de las noticias
     *
     * @return View
     */
    public function noticias()
    {
        $this->estableceIdioma();
        $menus = Menu::orderBy('order')->get();
        $noticias = Content::where('tipo_contenido','noticia')
            ->where('fecha_publicacion','<=',date('Y-m-d'))
            ->orderBy('fecha','DESC')->get();
        //Metas
        $metas = Web::devuelveMetas('contents','noticias',1);
        //Definimos el array con los elementos del breadcrum
        $elementos = ['Inicio','El Festival','Noticias'];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        return view('web.noticias',compact('menus','noticias','breadcrums','metas'));
    }

    /**
     * Muestra la página de las entrevistas
     *
     * @return View
     */
    public function entrevistas()
    {
        $this->estableceIdioma();
        $menus = Menu::orderBy('order')->get();
        $entrevistas = Content::where('tipo_contenido','entrevista')
            ->where('fecha_publicacion','<=',date('Y-m-d'))
            ->orderBy('fecha','DESC')->get();
        //Metas
        $metas = Web::devuelveMetas('contents','entrevistas',1);
        //Definimos el array con los elementos del breadcrum
        $elementos = ['Inicio','El Festival','Entrevistas'];
        $breadcrums = $this->devuelveBreadcrums($elementos);
        return view('web.entrevistas',compact('menus','entrevistas','breadcrums','metas'));
    }

    /**
     * Muestra la página del del detalle tanto de páginas, noticias y entrevistas
     *
     * @return View
     */
    public function detalle()
    {
        $this->estableceIdioma();
        $slug = explode('/',$_SERVER["REQUEST_URI"])[count(explode('/',$_SERVER["REQUEST_URI"]))-1];
        $textosidioma = TextosIdioma::where('slug',$slug)->where('tipo_contenido_id',1)->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->first();
        if (is_object($textosidioma))
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
                ->where('fecha_publicacion','<=',date('Y-m-d'))
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
            $elementos = ['Inicio', $textosidioma->titulo];
            //Metas
            $metas = Web::devuelveMetas('contents',$slug,1);
            $breadcrums = $this->devuelveBreadcrums($elementos);
            return view('web.detalle', compact('menus', 'textosidioma', 'breadcrums', 'content','registros','metas'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Muestra la página del programa de eventos
     *
     * @return View
     */
    public function agenda()
    {
        $this->estableceIdioma();
        $menus = Menu::orderBy('order')->get();
        $agenda = Agenda::orderBy('fecha')->orderBy('hora')->get();
        //Definimos el array con los elemento del breadcrum
        $elementos = ['Inicio','El Festival','Programa'];
        $dias_evento = ['Sábado','Domingo','Lunes'];
        //Metas
        $metas = Web::devuelveMetas('contents','agenda',1);
        $breadcrums = $this->devuelveBreadcrums($elementos);
        return view('web.agenda',compact('menus','agenda','breadcrums','dias_evento','metas'));
    }

    /**
     * Muestra el detalle de cada ponente pasado en el parámetro slug (url-amigable)
     *
     * @return View
     */
    public function detalleponentes($slug)
    {
        $this->estableceIdioma();
        $menus = Menu::orderBy('order')->get();
        $textosidioma = TextosIdioma::where('slug',$slug)->where('tipo_contenido_id',3)->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->first();
        if (is_object($textosidioma)) {
            $ponente = Ponente::findOrFail($textosidioma->contenido_id);
            $agenda = DB::table('ponentes_agenda')
                ->join('agenda', 'ponentes_agenda.agenda_id', 'agenda.id')
                ->join('textos_idiomas', 'agenda.id', 'textos_idiomas.contenido_id')
                ->join('zonas', 'agenda.zona_id', 'zonas.id')
                ->where('textos_idiomas.tipo_contenido_id', '2')
                ->where('ponentes_agenda.ponentes_id', $ponente->id)
                ->OrderBy('agenda.fecha')->OrderBy('agenda.hora')->get();
            //Definimos el array con los elemento del breadcrum
            $elementos = ['Inicio', 'El Festival', 'Ponentes', $textosidioma->titulo];
            //Metas
            $metas = Web::devuelveMetas('ponentes',$slug,3);
            $breadcrums = $this->devuelveBreadcrums($elementos);

            return view('web.detalleponentes', compact('menus', 'ponente', 'textosidioma', 'breadcrums', 'agenda','metas'));
        } else{
            return view('errors.404',compact('menus'));
        }
    }

    /**
     * Devuelve un array con los elementos del breadcrums y sus url amigables de cada página
     * Recibe un array con los elementos que formartán el breadcrum
     *
     * @param  Array $elementos
     * @return Array $breadcrums
     */
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

    /**
     * Establece el idioma principal dependiendo del codigo de idioma que venga en la url
     *
     *
     */
    public function estableceIdioma(){
        //Si accedemos a una url interna que no sea el index hay que capturar con qué idioma viene para activar la vble de sesión
        $url = $_SERVER["REQUEST_URI"];
        $codigo = explode('/', $url)[1];
        if ($codigo != 'eunomia' && $codigo != 'login') {
            $idioma = Idioma::fromCodigo($codigo);
            if ($idioma > 0) {
                Session::put('idioma', $codigo);
                App::SetLocale(Session::get('idioma'));
            } else {
                Session::put('idioma', Idioma::where('principal', '1')->first()->codigo);
                App::SetLocale(Session::get('idioma'));
            }
        }
    }
}