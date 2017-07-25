<?php

namespace App\Http\Controllers;

use App\Portada;
use App\Idioma;
use Image;
use App\TextosIdioma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Str;


class PortadaController extends Controller
{
    protected $tipo_contenido = 4; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada, 5 - Galería

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portada = DB::table('portada')
            ->join('textos_idiomas','portada.id','=','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('portada.id','titulo','subtitulo','contenido','metadescripcion','metatitulo','visible','principal','idioma','idiomas.imagen','portada.orden')
            ->where('principal','1')
            ->where('tipo_contenido_id',$this->tipo_contenido)
            ->orderBy('textos_idiomas.titulo','ASC')->get();
        return view('eunomia.portada.listado_portada', compact('portada'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idiomas = Idioma::where('activado','1')->orderByDesc('idioma')->get();
        return view('eunomia.portada.form_ins_portada',compact('idiomas'));
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

        $portada = new Portada();

        if($request->hasFile('imagen')){

            $imagen = $request->file('imagen');

            $filename = time() . '.' . $imagen->getClientOriginalExtension();


            $dirl = 'images/portada/l/';
            if (!File::exists($dirl)){
                File::makeDirectory($dirl);
            }

            $dirm = 'images/portada/m/';
            if (!File::exists($dirm)){
                File::makeDirectory($dirm);
            }
            $dirs = 'images/portada/s/';
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

            $portada->imagen = $filename;

        }

        $portada->url = $request->url;
        $maxorden = Portada::max('orden');
        $portada->orden = is_numeric($maxorden)?$maxorden+1:1;

        if ($portada->save()) {
            $lastId = $portada->id;

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

        return redirect('eunomia/portada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Portada  $portada
     * @return \Illuminate\Http\Response
     */
    public function show(Portada $portada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portada  $portada
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();
        $textos = DB::table('portada')
            ->join('textos_idiomas','portada.id','=','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('portada.id as portada_id','titulo','subtitulo','contenido','metadescripcion','metatitulo','visible','principal','idioma','idiomas.imagen','codigo','textos_idiomas.idioma_id')
            ->where('tipo_contenido_id',$this->tipo_contenido)
            ->where('portada.id',$id)
            ->orderBy('principal','DESC')->get();
        $portada = Portada::findOrFail($id);
        return view('eunomia.portada.form_edit_portada',compact('idiomas','portada','textos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portada  $portada
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

        $portada = Portada::findOrFail($id);

        $imagenactual = $portada->imagen;

        if($request->hasFile('imagen')){

            File::delete('images/portada/l/'.$imagenactual);
            File::delete('images/portada/m/'.$imagenactual);
            File::delete('images/portada/s/'.$imagenactual);

            $imagen = $request->file('imagen');

            $filename = time() . '.' . $imagen->getClientOriginalExtension();

            $dirl = 'images/portada/l/';
            if (!File::exists($dirl)){
                File::makeDirectory($dirl);
            }

            $dirm = 'images/portada/m/';
            if (!File::exists($dirm)){
                File::makeDirectory($dirm);
            }
            $dirs = 'images/portada/s/';
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

            $portada->imagen = $filename;

        }

        $portada->url = $request->url;

        if ($portada->save()) {

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

        return redirect('eunomia/portada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portada  $portada
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminamos los textos en los idiomas
        $textosIdioma = TextosIdioma::where('contenido_id',$id)
            ->where('tipo_contenido_id',$this->tipo_contenido);
        $textosIdioma->delete();
        $portada = Portada::findOrfail($id);
        //Eliminamos las imagenes en los diferentes tamaños
        $imagenactual = $portada->imagen;
        File::delete('images/portada/l/'.$imagenactual);
        File::delete('images/portada/m/'.$imagenactual);
        File::delete('images/portada/s/'.$imagenactual);
        //Eliminamos la entrada del contenido
        $portada->delete();
        return redirect('eunomia/portada');
    }

    public function UpdateRowOrder($id,$oldPosition,$newPosition)
    {
        if ($newPosition > $oldPosition) {
            Portada::where('orden', '>=', $newPosition)
                ->update(['orden' => 'orden-1']);
        } else {
            Portada::where('orden', '<=', $newPosition)
                ->update(['orden' => 'orden+1']);
        }
    }
}
