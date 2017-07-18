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

class ContentController extends Controller
{
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
            ->select('contents.id','tipo_contenido','titulo','subtitulo','contenido','metadescripcion','metatitulo','visible','principal','idioma','idiomas.imagen')
            ->orderBy('contents.id','ASC')->orderBy('principal','DESC')->get();
        return view('eunomia.contents.listado_contents', compact('contents_principal','contents'));
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


            Image::make($imagen)->fit(970, null, function ($constraint) {
                $constraint->upsize();
            })->save('images/contenido/l/'.$filename );

            Image::make($imagen)->fit(768, null, function ($constraint) {
                $constraint->upsize();
            })->save('images/contenido/m/'.$filename );

            Image::make($imagen)->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            })->save('images/contenido/s/'.$filename );

            // Image::make($imagen)->resize(1440,null, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save('images/contenido/m/'.$filename , 95 );

            $content->imagen = $filename;

        }

        $content->lugar = $request->lugar;
        $date = Carbon::createFromFormat('d/m/Y',$request->fecha);
        $content->fecha = $date;
        $content->tipo_contenido = $request->tipo_contenido;

        if ($content->save()) {
            $lastId = $content->id;
            $cont=0;

            foreach($idiomas as $idioma) {

                if ($request->titulo[$cont] != '') {
                    $textosIdioma = new TextosIdioma();
                    $textosIdioma->idioma_id = $idioma->id;
                    $textosIdioma->contenido_id = $lastId;
                    $textosIdioma->tipo_contenido_id = 1; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada
                    $textosIdioma->titulo = $request->titulo[$cont];
                    $textosIdioma->subtitulo = $request->subtitulo[$cont];
                    $textosIdioma->contenido = $request->contenido[$cont];
                    $textosIdioma->metadescripcion = $request->metadescripcion[$cont];
                    $textosIdioma->metatitulo = $request->metatitulo[$cont];

                    $textosIdioma->save();
                }
                $cont++;
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
            ->select('contents.id as content_id','tipo_contenido','titulo','subtitulo','contenido','metadescripcion','metatitulo','visible','principal','idioma','idiomas.imagen')
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
        $content = Content::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        //
    }
}
