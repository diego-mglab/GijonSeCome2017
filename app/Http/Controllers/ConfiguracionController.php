<?php

namespace App\Http\Controllers;

use App\Configuracion;
use Illuminate\Http\Request;
use App\Idioma;
use Illuminate\Support\Facades\DB;
use App\TextosIdioma;


class ConfiguracionController extends Controller
{
    protected $tipo_contenido = 9;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuracion = Configuracion::first();
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();
        $textos = DB::table('contents')
            ->join('textos_idiomas','contents.id','=','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('contents.id as content_id','tipo_contenido','columnas','titulo','subtitulo','contenido','metadescripcion','metatitulo','slug','visible','principal','idioma','idiomas.imagen','codigo','textos_idiomas.idioma_id')
            ->where('tipo_contenido_id',$this->tipo_contenido)
            ->where('contents.id',$configuracion->id)
            ->orderBy('principal','DESC')->get();
        return view('eunomia.configuracion.form_edit_configuracion',compact('configuracion','idiomas','textos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function show(Configuracion $configuracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuracion $configuracion)
    {
        $configuracion = Configuracion::first();
        return view('eunomia.configuracion.form_edit_configuracion',compact('configuracion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $idiomas = Idioma::where('activado','1')->orderByDesc('principal')->get();

        foreach ($idiomas as $idioma) {
            if ($idioma->principal == 1)
                $this->validate($request, [
                    'metatitulo' => 'required'
                ]);
        }

        $configuracion = Configuracion::findOrFail($id);

        $configuracion->nombre_empresa = $request->nombre_empresa;
        $configuracion->direccion_empresa = $request->direccion_empresa;
        $configuracion->nif_cif = $request->nif_cif;
        $configuracion->telefono_empresa = $request->telefono_empresa;
        $configuracion->movil_empresa = $request->movil_empresa;
        $configuracion->email = $request->email;
        $configuracion->g_analytics = $request->g_analytics;
        $configuracion->url = $request->url;

        if ($configuracion->save()) {

            //dd($request->visible);
            for($i=0;$i<count($request->idioma_id);$i++) {
                $textosIdioma = TextosIdioma::where('contenido_id',$id)
                    ->where('tipo_contenido_id',$this->tipo_contenido)
                    ->where('idioma_id',$request->idioma_id[$i])->first();
                if (count($textosIdioma) == 0) {
                    $textosIdioma = new TextosIdioma();
                }
                if ($request->metatitulo[$i] != '') {
                    $textosIdioma->idioma_id = $request->idioma_id[$i];
                    $textosIdioma->contenido_id = $id;
                    $textosIdioma->tipo_contenido_id = $this->tipo_contenido;
                    $textosIdioma->metadescripcion = $request->metadescripcion[$i];
                    $textosIdioma->metatitulo = $request->metatitulo[$i];

                    $textosIdioma->save();
                }
            }

        }

        return redirect('eunomia/configuracion');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuracion $configuracion)
    {
        //
    }
}
