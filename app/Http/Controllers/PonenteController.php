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
    protected $tipo_contenido = 3; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada, 5 - Galería, 6 - Menú, 7 - Multimedia, 8 - Documentos Prensa, 9 - Configuracion

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
            ->select('ponentes.id','ponentes.anio','ponentes.imagen as imagen_ponentes','imagenslide','orden','titulo','subtitulo','contenido','metadescripcion','metatitulo','visible','principal','idioma','idiomas.imagen')
            ->where('principal','1')
            ->where('tipo_contenido_id',$this->tipo_contenido)
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
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();
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
        $url = $request->url;
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


            $dirl = 'images/chefs/l/';
            if (!File::exists($dirl)){
                File::makeDirectory($dirl);
            }

            $dirm = 'images/chefs/m/';
            if (!File::exists($dirm)){
                File::makeDirectory($dirm);
            }

            Image::make($imagen)->resize(768, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dirl.$filename, 95 );

            Image::make($imagen)->fit(480, 480, function ($constraint) {
                $constraint->upsize();
            })->save($dirm.$filename );

            $ponente->imagen = $filename;

        }

        if($request->hasFile('imagenslide')){

            $imagen = $request->file('imagenslide');

            $filename = time() . '.' . $imagen->getClientOriginalExtension();

            $dirs = 'images/chefs/s/';
            if (!File::exists($dirs)){
                File::makeDirectory($dirs);
            }


            Image::make($imagen)->fit(220, 150, function ($constraint) {
                $constraint->upsize();
            })->save($dirs.$filename );

            $ponente->imagenslide = $filename;
        }

        //Metemos en el campo anio el año actual para poder consultar ediciones pasadas
        $ponente->anio = date('Y');

        $maxorden = Ponente::max('orden');
        $ponente->orden = is_numeric($maxorden)?$maxorden+1:1;

        if ($ponente->save()) {
            $lastId = $ponente->id;

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
                    $textosIdioma->slug = Str::Slug($request->titulo[$i]).'-'.date('Y');
                    $textosIdioma->visible = 0;
                    foreach($request->visible as $visible) {
                        if ($visible == $request->idioma_id[$i])
                            $textosIdioma->visible = 1;
                    }

                    $textosIdioma->save();
                }
            }

        }

        return redirect($url);
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
    public function edit($id)
    {
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();
        $textos = DB::table('ponentes')
            ->join('textos_idiomas','ponentes.id','=','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('ponentes.id as ponente_id','titulo','subtitulo','contenido','metadescripcion','metatitulo','visible','principal','idioma','idiomas.imagen','codigo','textos_idiomas.idioma_id')
            ->where('tipo_contenido_id',$this->tipo_contenido)
            ->where('ponentes.id',$id)
            ->orderBy('principal','DESC')->get();
        $ponente = Ponente::findOrFail($id);
        return view('eunomia.ponentes.form_edit_ponentes',compact('idiomas','ponente','textos'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ponente  $ponente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $url = $request->url;
        $idiomas = Idioma::where('activado','1')->orderByDesc('principal')->get();

        foreach ($idiomas as $idioma) {
            if ($idioma->principal == 1)
                $this->validate($request, [
                    'titulo' => 'required'
                ]);
        }

        $ponente = Ponente::findOrFail($id);

        $imagenactual = $ponente->imagen;

        if($request->hasFile('imagen')){

            $dirl = 'images/chefs/l/';
            if (!File::exists($dirl)){
                File::makeDirectory($dirl);
            }

            $dirm = 'images/chefs/m/';
            if (!File::exists($dirm)){
                File::makeDirectory($dirm);
            }

            File::delete($dirl.$imagenactual);
            File::delete($dirm.$imagenactual);

            $imagen = $request->file('imagen');

            $filename = time() . '.' . $imagen->getClientOriginalExtension();


            Image::make($imagen)->resize(768, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dirl.$filename, 95 );

            Image::make($imagen)->fit(480, 480, function ($constraint) {
                $constraint->upsize();
            },'top')->save($dirm.$filename );

            $ponente->imagen = $filename;

        }

        if($request->hasFile('imagenslide')){

            $imagen = $request->file('imagenslide');

            $filename = time() . '.' . $imagen->getClientOriginalExtension();

            $dirs = 'images/chefs/s/';
            if (!File::exists($dirs)){
                File::makeDirectory($dirs);
            }


            Image::make($imagen)->fit(220, 150, function ($constraint) {
                $constraint->upsize();
            })->save($dirs.$filename );

            $ponente->imagenslide = $filename;

        }

        if ($ponente->save()) {
            //dd($request->visible);
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
                    if ($ponente->anio > '2016')
                        $textosIdioma->slug = Str::Slug($request->titulo[$i]).'-'.$ponente->anio;
                    else
                        $textosIdioma->slug = Str::Slug($request->titulo[$i]);
                    $textosIdioma->visible = 0;
                    if (isset($request->visible)) {
                        foreach ($request->visible as $visible) {
                            if ($visible == $request->idioma_id[$i])
                                $textosIdioma->visible = 1;
                        }
                    }
                    //dd($textosIdioma);


                    $textosIdioma->save();
                }
            }

        }

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ponente  $ponente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $textosIdioma = TextosIdioma::where('contenido_id',$id)
            ->where('tipo_contenido_id',$this->tipo_contenido);
        $textosIdioma->delete();
        $ponente = Ponente::findOrfail($id);
        $imagenactual = $ponente->imagen;
        File::delete('images/contenido/l/'.$imagenactual);
        File::delete('images/contenido/m/'.$imagenactual);
        File::delete('images/contenido/s/'.$imagenactual);
        $ponente->delete();
        return redirect('eunomia/ponentes');
    }
}
