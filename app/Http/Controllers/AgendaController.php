<?php

namespace App\Http\Controllers;

use App\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Idioma;
use App\TextosIdioma;
use App\Ponente;
use App\Zona;
use App\PonentesAgenda;
use Carbon\Carbon;
use Str;





class AgendaController extends Controller
{
    protected $tipo_contenido = 2; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada, 5 - Galería, 6 - Menú, 7 - Multimedia, 8 - Documentos Prensa

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = DB::table('agenda')
            ->join('textos_idiomas','agenda.id','=','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->join('zonas','agenda.zona_id','zonas.id')
            ->select('agenda.id','fecha','hora','titulo','subtitulo','contenido','metadescripcion','metatitulo','visible','principal','idioma','idiomas.imagen','zonas.nombre as zona')
            ->where('principal','1')
            ->where('tipo_contenido_id',$this->tipo_contenido)
            ->orderBy('textos_idiomas.titulo','ASC')->get();
        return view('eunomia.agenda.listado_agenda', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ponentes = DB::table('ponentes')
            ->join('textos_idiomas','ponentes.id','=','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('titulo','ponentes.id as id')
            ->where('tipo_contenido_id',3)
            ->where('principal','1')
            ->where('anio',date('Y'))
            ->orderBy('titulo')
            ->pluck('titulo','id'); // titulo como nombre del ponente
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();
        $zonas = Zona::all()->pluck('nombre','id');
        $tipos_evento = ['showcooking' => 'showcooking','ponencia' => 'ponencia','otros' => 'otros'];
        return view('eunomia.agenda.form_ins_agenda',compact('idiomas','ponentes','zonas','tipos_evento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();

        $this->validate($request, [
           'fecha' => 'required',
           'hora' => 'required',
           'zona_id' => 'required',
           'ponentes' => 'required',
           'tipo_evento' => 'required'
        ]);
        foreach ($idiomas as $idioma) {
            if ($idioma->principal == 1)
                $this->validate($request, [
                    'titulo' => 'required'
                ]);
        }

        $agenda = new Agenda();

        if ($request->fecha != '') {
            $fecha_evento = Carbon::createFromFormat('d/m/Y', $request->fecha);
            $agenda->fecha = $fecha_evento;
        }
        $agenda->hora = $request->hora;
        $agenda->zona_id = $request->zona_id;
        $agenda->tipo_evento = $request->tipo_evento;


        if ($agenda->save()) {
            $lastId = $agenda->id;

            // TextosIdioma
            for($i=0;$i<count($request->idioma_id);$i++) {

                if ($request->titulo[$i] != '') {
                    $textosIdioma = new TextosIdioma();
                    $textosIdioma->idioma_id = $request->idioma_id[$i];
                    $textosIdioma->contenido_id = $lastId;
                    $textosIdioma->tipo_contenido_id = $this->tipo_contenido;
                    $textosIdioma->titulo = $request->titulo[$i];
                    $textosIdioma->subtitulo = $request->subtitulo[$i];
                    $textosIdioma->contenido = $request->contenido[$i];
                    $textosIdioma->metadescripcion = $request->metadescripcion[$i];
                    $textosIdioma->metatitulo = $request->metatitulo[$i];
                    //$textosIdioma->slug = Str::Slug($request->titulo[$i]);
                    $textosIdioma->visible = 0;
                    foreach($request->visible as $visible) {
                        if ($visible == $request->idioma_id[$i])
                            $textosIdioma->visible = 1;
                    }

                    $textosIdioma->save();
                }
            }

            //Ponentes
            $ponentes = $request->ponentes;
            if (isset($ponentes)) {
                foreach ($ponentes as $ponente) {
                    $ponentesAgenda = new PonentesAgenda();
                    $ponentesAgenda->ponentes_id = $ponente;
                    $ponentesAgenda->agenda_id = $lastId;

                    $ponentesAgenda->save();
                }
            }
        }

        return redirect('eunomia/agenda');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        $allponentes = DB::table('ponentes')
            ->join('textos_idiomas','ponentes.id','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('titulo','ponentes.id as id')
            ->where('tipo_contenido_id',3)
            ->where('principal','1')
            ->where('anio',date('Y'))
            ->orderBy('titulo')
            ->pluck('titulo','id'); // titulo como nombre del ponente
        $ponentes = DB::table('ponentes')
            ->join('textos_idiomas','ponentes.id','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->join('ponentes_agenda','ponentes.id','ponentes_agenda.ponentes_id')
            ->select('titulo','ponentes.id as id')
            ->where('tipo_contenido_id',3)
            ->where('principal','1')
            ->where('ponentes_agenda.agenda_id',$id)
            ->pluck('id')->toArray(); // titulo como nombre del ponente
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();
        $zonas = Zona::all()->pluck('nombre','id');
        $textos = DB::table('agenda')
            ->join('textos_idiomas','agenda.id','=','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('agenda.id as agenda_id','titulo','subtitulo','contenido','metadescripcion','metatitulo','visible','principal','idioma','idiomas.imagen','codigo','textos_idiomas.idioma_id')
            ->where('tipo_contenido_id',$this->tipo_contenido)
            ->where('agenda.id',$id)
            ->orderBy('principal','DESC')->get();
        $tipos_evento = ['showcooking' => 'showcooking','ponencia' => 'ponencia','otros' => 'otros'];
        return view('eunomia.agenda.form_edit_agenda',compact('idiomas','agenda','ponentes','zonas','allponentes','textos','tipos_evento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $idiomas = Idioma::where('activado','1')->orderByDesc('principal')->get();

        $this->validate($request, [
            'fecha' => 'required',
            'hora' => 'required',
            'ponentes' => 'required',
            'zona_id' => 'required'
        ]);
        foreach ($idiomas as $idioma) {
            if ($idioma->principal == 1)
                $this->validate($request, [
                    'titulo' => 'required'
                ]);
        }

        $agenda = Agenda::findOrFail($id);


        if ($request->fecha != '') {
            $fecha_evento = Carbon::createFromFormat('d/m/Y', $request->fecha);
            $agenda->fecha = $fecha_evento;
        }
        $agenda->hora = $request->hora;
        $agenda->zona_id = $request->zona_id;
        $agenda->tipo_evento = $request->tipo_evento;

        if ($agenda->save()) {

            for($i=0;$i<count($request->idioma_id);$i++) {
                $textosIdioma = TextosIdioma::where('contenido_id',$id)
                    ->where('tipo_contenido_id',$this->tipo_contenido)
                    ->where('idioma_id',$request->idioma_id[$i])->first();
                if (count($textosIdioma) == 0) {
                    $textosIdioma = new TextosIdioma();
                }
                if ($request->titulo[$i] != '') {
                    $textosIdioma->idioma_id = $request->idioma_id[$i];
                    $textosIdioma->contenido_id = $id;
                    $textosIdioma->tipo_contenido_id = $this->tipo_contenido;
                    $textosIdioma->titulo = $request->titulo[$i];
                    $textosIdioma->subtitulo = $request->subtitulo[$i];
                    $textosIdioma->contenido = $request->contenido[$i];
                    $textosIdioma->metadescripcion = $request->metadescripcion[$i];
                    $textosIdioma->metatitulo = $request->metatitulo[$i];
                    //$textosIdioma->slug = Str::Slug($request->titulo[$i]);
                    $textosIdioma->visible = 0;
                    foreach($request->visible as $visible) {
                        if ($visible == $request->idioma_id[$i])
                            $textosIdioma->visible = 1;
                    }

                    $textosIdioma->save();
                }
            }
            // Eliminamos los ponentes de la agenda para volver a insertar los nuevos
            PonentesAgenda::where('agenda_id',$id)->delete();
            $ponentes = $request->ponentes;
            if (isset($ponentes)) {
                foreach ($ponentes as $ponente) {
                    $ponentesAgenda = new PonentesAgenda();
                    $ponentesAgenda->ponentes_id = $ponente;
                    $ponentesAgenda->agenda_id = $id;

                    $ponentesAgenda->save();
                }
            }
        }


        return redirect('eunomia/agenda');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminamos los textos en los idiomas
        $textosIdioma = TextosIdioma::where('contenido_id',$id)
            ->where('tipo_contenido_id',$this->tipo_contenido);
        $textosIdioma->delete();
        //Eliminamos los ponentes
        PonentesAgenda::where('agenda_id',$id)->delete();
        //Eliminamos la entrada en la agenda
        Agenda::findOrfail($id)->delete();
        return redirect('eunomia/agenda');
    }

}
