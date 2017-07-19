<?php

namespace App\Http\Controllers;

use App\Ponente;
use Illuminate\Http\Request;
use Image;
use App\Idioma;
use App\TextosIdioma;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use File;
use Str;


class PonenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ponentes = DB::table('ponentes')
            ->join('textos_idiomas','ponentes.id','=','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('ponentes.id','ponentes.imagen as imagen_ponentes','imagenslide','orden','titulo','subtitulo','contenido','metadescripcion','metatitulo','visible','principal','idioma','idiomas.imagen')
            ->where('principal','1')
            ->orderBy('textos_idiomas.titulo','ASC')->get();
        return view('eunomia.ponentes.listado_ponentes', compact('ponentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idiomas = Idioma::where('activado','1')->orderByDesc('idioma')->get();
        return view('eunomia.ponentes.form_ins_ponentes',compact('idiomas'));
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

        foreach ($idiomas as $idioma) {
            if ($idioma->principal == 1)
                $this->validate($request, [
                    'titulo' => 'required'
                ]);
        }

        $ponente = new Ponente();


        if($request->hasFile('imagen')){

            $imagen = $request->file('imagen');

            $filename = time() . '.' . $imagen->getClientOriginalExtension();


            $dir = 'images/chefs/l/';
            if (!File::exists($dir)){
                File::makeDirectory($dir);
            }

            $dir = 'images/chefs/m/';
            if (!File::exists($dir)){
                File::makeDirectory($dir);
            }

            Image::make($imagen)->resize(768, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/chefs/l/'.$filename, 95 );

            Image::make($imagen)->fit(480, 480, function ($constraint) {
                $constraint->upsize();
            })->save('images/chefs/m/'.$filename );

            $ponente->imagen = $filename;

        }

        if($request->hasFile('imagenslide')){

            $imagen = $request->file('imagenslide');

            $filename = time() . '.' . $imagen->getClientOriginalExtension();

            $dir = 'images/chefs/s/';
            if (!File::exists($dir)){
                File::makeDirectory($dir);
            }


            Image::make($imagen)->fit(220, 150, function ($constraint) {
                $constraint->upsize();
            })->save('images/chefs/s/'.$filename );

            $ponente->imagenslide = $filename;

        }

        if ($ponente->save()) {
            $lastId = $ponente->id;

            for($i=0;$i<count($request->idioma_id);$i++) {

                if ($request->titulo[$i] != '') {
                    $textosIdioma = new TextosIdioma();
                    $textosIdioma->idioma_id = $request->idioma_id[$i];
                    $textosIdioma->contenido_id = $lastId;
                    $textosIdioma->tipo_contenido_id = 3; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada
                    $textosIdioma->titulo = $request->titulo[$i];
                    $textosIdioma->subtitulo = $request->subtitulo[$i];
                    $textosIdioma->contenido = $request->contenido[$i];
                    $textosIdioma->metadescripcion = $request->metadescripcion[$i];
                    $textosIdioma->metatitulo = $request->metatitulo[$i];
                    $textosIdioma->slug = Str::Slug($request->titulo[$i]);
                    $textosIdioma->visible = 0;
                    foreach($request->visible as $visible) {
                        if ($visible == $request->idioma_id[$i])
                            $textosIdioma->visible = 1;
                    }

                    $textosIdioma->save();
                }
            }

        }

        return redirect('eunomia/ponentes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ponente  $ponente
     * @return \Illuminate\Http\Response
     */
    public function show(Ponente $ponente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ponente  $ponente
     * @return \Illuminate\Http\Response
     */
    public function edit(Ponente $ponente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ponente  $ponente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ponente $ponente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ponente  $ponente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ponente $ponente)
    {
        //
    }
}
