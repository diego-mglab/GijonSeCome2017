<?php

namespace App\Http\Controllers;

use App\Content;
use App\Idioma;
use Image;
use App\TextosIdioma;
use App\TipoContenido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Str;
use File;


class ContentController extends Controller
{
    protected $tipo_contenido = 1; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada, 5 - Galería, 6 - Menú

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = DB::table('contents')
            ->join('textos_idiomas','contents.id','=','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('contents.id','tipo_contenido','pagina_estatica','titulo','subtitulo','contenido','metadescripcion','metatitulo','visible','principal','idioma','idiomas.imagen')
            ->where('principal','1')
            ->where('tipo_contenido_id',$this->tipo_contenido)
            ->orderBy('textos_idiomas.titulo','ASC')->get();
        return view('eunomia.contents.listado_contents', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposContenido = TipoContenido::all()->pluck('tipo_contenido','id');
        $idiomas = Idioma::where('activado','1')->orderByDesc('idioma')->get();
        return view('eunomia.contents.form_ins_contents',compact('tiposContenido','idiomas'));
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

        $content = new Content();

        if($request->hasFile('imagen')){

            $imagen = $request->file('imagen');

            $filename = time() . '.' . $imagen->getClientOriginalExtension();

            $dirl = 'images/contenido/l/';
            if (!File::exists($dirl)){
                File::makeDirectory($dirl);
            }

            $dirm = 'images/contenido/m/';
            if (!File::exists($dirm)){
                File::makeDirectory($dirm);
            }
            $dirs = 'images/contenido/s/';
            if (!File::exists($dirs)){
                File::makeDirectory($dirs);
            }

            Image::make($imagen)->resize(970, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dirl.$filename, 95 );

            Image::make($imagen)->resize(768, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dirm.$filename, 95 );

            Image::make($imagen)->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            })->save($dirs.$filename );

            $content->imagen = $filename;

        }

        $content->lugar = $request->lugar;
        if ($request->fecha != '') {
            $fecha_noticia = Carbon::createFromFormat('d/m/Y', $request->fecha);
            $content->fecha = $fecha_noticia;
        }
        if ($request->fecha_publicacion != '') {
            $fecha_publicacion = Carbon::createFromFormat('d/m/Y', $request->fecha_publicacion);
            $content->fecha_publicacion = $fecha_publicacion;
        }
        $content->tipo_contenido = $request->tipo_contenido;

        if ($request->tipo_contenido == 'pagina')
            if (isset($request->pagina_estatica))
                $content->pagina_estatica 	= '1';
            else
                $content->pagina_estatica = '0';

        if ($content->save()) {
            $lastId = $content->id;

            for ($i = 0; $i < count($request->idioma_id); $i++) {

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
                    $textosIdioma->slug = Str::Slug($request->titulo[$i]);
                    $textosIdioma->visible = 0;
                    foreach ($request->visible as $visible) {
                        if ($visible == $request->idioma_id[$i])
                            $textosIdioma->visible = 1;
                    }

                    $textosIdioma->save();
                }
            }

        }

        return redirect('eunomia/contents');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();
        $textos = DB::table('contents')
            ->join('textos_idiomas','contents.id','=','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('contents.id as content_id','tipo_contenido','titulo','subtitulo','contenido','metadescripcion','metatitulo','visible','principal','idioma','idiomas.imagen','codigo','textos_idiomas.idioma_id')
            ->where('tipo_contenido_id',$this->tipo_contenido)
            ->where('contents.id',$id)
            ->orderBy('principal','DESC')->get();
        $content = Content::findOrFail($id);
        return view('eunomia.contents.form_edit_contents',compact('idiomas','content','textos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $idiomas = Idioma::where('activado','1')->orderByDesc('principal')->get();

        foreach ($idiomas as $idioma) {
            if ($idioma->principal == 1)
                $this->validate($request, [
                    'titulo' => 'required'
                ]);
        }

        $content = Content::findOrFail($id);

        $imagenactual = $content->imagen;

        if($request->hasFile('imagen')){

            File::delete('images/contenido/l/'.$imagenactual);
            File::delete('images/contenido/m/'.$imagenactual);
            File::delete('images/contenido/s/'.$imagenactual);

            $imagen = $request->file('imagen');

            $filename = time() . '.' . $imagen->getClientOriginalExtension();

            $dirl = 'images/contenido/l/';
            if (!File::exists($dirl)){
                File::makeDirectory($dirl);
            }

            $dirm = 'images/contenido/m/';
            if (!File::exists($dirm)){
                File::makeDirectory($dirm);
            }
            $dirs = 'images/contenido/s/';
            if (!File::exists($dirs)){
                File::makeDirectory($dirs);
            }

            Image::make($imagen)->resize(970, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dirl.$filename, 95 );

            Image::make($imagen)->resize(768, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dirm.$filename, 95 );

            Image::make($imagen)->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            })->save($dirs.$filename );

            $content->imagen = $filename;

        }

        $content->lugar = $request->lugar;
        if ($request->fecha != '') {
            $fecha_noticia = Carbon::createFromFormat('d/m/Y', $request->fecha);
            $content->fecha = $fecha_noticia;
        }
        if ($request->fecha_publicacion != '') {
            $fecha_publicacion = Carbon::createFromFormat('d/m/Y', $request->fecha_publicacion);
            $content->fecha_publicacion = $fecha_publicacion;
        }

        if ($request->tipo_contenido == 'pagina')
            if (isset($request->pagina_estatica))
                $content->pagina_estatica 	= '1';
            else
                $content->pagina_estatica = '0';

        if ($content->save()) {

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

        return redirect('eunomia/contents');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminamos los textos en los idiomas
        $textosIdioma = TextosIdioma::where('contenido_id',$id)
            ->where('tipo_contenido_id',$this->tipo_contenido);
        $textosIdioma->delete();
        $content = Content::findOrfail($id);
        //Eliminamos las imagenes en los diferentes tamaños
        $imagenactual = $content->imagen;
        File::delete('images/contenido/l/'.$imagenactual);
        File::delete('images/contenido/m/'.$imagenactual);
        File::delete('images/contenido/s/'.$imagenactual);
        //Eliminamos la entrada del contenido
        $content->delete();
        return redirect('eunomia/contents');
    }
}
