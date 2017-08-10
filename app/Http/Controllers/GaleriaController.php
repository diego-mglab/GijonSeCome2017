<?php

namespace App\Http\Controllers;

use App\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Idioma;
use App\TextosIdioma;
use App\Multimedia;
use Str;
use File;
use Image;


class GaleriaController extends Controller
{
    protected $tipo_contenido = 5; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada, 5 - Galería, 6 - Menú, 7 - Multimedia

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galerias = DB::table('galerias')
            ->join('textos_idiomas', 'galerias.id', '=', 'textos_idiomas.contenido_id')
            ->join('idiomas', 'textos_idiomas.idioma_id', 'idiomas.id')
            ->select('galerias.id', 'galerias.anio', 'titulo', 'subtitulo', 'contenido', 'metadescripcion', 'metatitulo', 'visible', 'principal', 'idioma', 'idiomas.imagen', 'galerias.orden')
            ->where('principal', '1')
            ->where('tipo_contenido_id', $this->tipo_contenido)
            ->orderBy('textos_idiomas.titulo', 'ASC')->get();
        return view('eunomia.galerias.listado_galerias', compact('galerias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idiomas = Idioma::where('activado', '1')->orderBy('principal')->get();
        return view('eunomia.galerias.form_ins_galerias', compact('idiomas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->galeria_id > 0) { //Si se trata de una imagen de la galería
            $multimedia = new Multimedia();

            $multimedia->galeria_id = $request->galeria_id;

            $galeria = Galeria::findOrFail($request->galeria_id);

            if ($request->hasFile('imagen')) {

                $imagen = $request->file('imagen');

                $filename = time() . '.' . $imagen->getClientOriginalExtension();

                $carpeta = Str::Slug($galeria->carpeta);

                $dir = 'images/galerias/' . $carpeta . '/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir);
                }

                Image::make($imagen)->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($dir . $filename, 95);

                //Thumbnail
                $dir = 'images/galerias/' . $carpeta . '/th/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir);
                }

                Image::make($imagen)->fit(240, 240, function ($constraint) {
                    $constraint->upsize();
                })->save($dir . $filename);

                $multimedia->imagen = $filename;
            }

            if ($request->url != '') {
                $multimedia->tipo_multimedia = 'video';
                $multimedia->url = $request->url;
            } else {
                $multimedia->tipo_multimedia = 'imagen';
            }


            $multimedia->save();

            return redirect()->route('galerias.edit', ['id' => $request->galeria_id]);

        } else { // Si se trata de una galería

            $idiomas = Idioma::where('activado', '1')->orderBy('principal')->get();

            foreach ($idiomas as $idioma) {
                if ($idioma->principal == 1)
                    $idioma_principal_id = $idioma->id;
                $this->validate($request, [
                    'titulo' => 'required'
                ]);
            }

            $galeria = new Galeria();

            //Insertamos el año en curso en el campo anio para poder mostrar galerias de otros años
            $galeria->anio = date('Y');

            $maxorden = Galeria::max('orden');
            $galeria->orden = is_numeric($maxorden) ? $maxorden + 1 : 1;

            if ($galeria->save()) {
                $lastId = $galeria->id;

                for ($i = 0; $i < count($request->idioma_id); $i++) {

                    if ($request->titulo[$i] != '') {
                        $textosIdioma = new TextosIdioma();
                        $textosIdioma->idioma_id = $request->idioma_id[$i];
                        $textosIdioma->contenido_id = $lastId;
                        $textosIdioma->tipo_contenido_id = $this->tipo_contenido;
                        $textosIdioma->titulo = $request->titulo[$i];
                        $textosIdioma->subtitulo = $request->subtitulo[$i];
                        $textosIdioma->metadescripcion = $request->metadescripcion[$i];
                        $textosIdioma->metatitulo = $request->metatitulo[$i];
                        $textosIdioma->slug = Str::Slug($request->titulo[$i]);
                        $textosIdioma->visible = 0;
                        foreach ($request->visible as $visible) {
                            if ($visible == $request->idioma_id[$i])
                                $textosIdioma->visible = 1;
                        }

                        $textosIdioma->save();
                        if ($request->idioma_id[$i] == $idioma_principal_id) {
                            $titulo_para_slug = $request->titulo[$i];
                        }
                    }
                }

            }

            $carpeta = Str::Slug($titulo_para_slug);

            Galeria::where('id', $lastId)
                ->update(['carpeta' => $carpeta]);

            return redirect('eunomia/galerias');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Galeria $galeria
     * @return \Illuminate\Http\Response
     */
    public function show(Galeria $galeria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Galeria $galeria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idiomas = Idioma::where('activado', '1')->orderBy('principal')->get();
        $idiomas_imagenes = Idioma::where('activado', '1')->orderBy('principal', 'DESC')->get();
        $textos = DB::table('galerias')
            ->join('textos_idiomas', 'galerias.id', '=', 'textos_idiomas.contenido_id')
            ->join('idiomas', 'textos_idiomas.idioma_id', 'idiomas.id')
            ->select('galerias.id as galeria_id', 'titulo', 'subtitulo', 'metadescripcion', 'metatitulo', 'visible', 'principal', 'idioma', 'idiomas.imagen', 'codigo', 'textos_idiomas.idioma_id')
            ->where('tipo_contenido_id', $this->tipo_contenido)
            ->where('galerias.id', $id)
            ->orderBy('principal', 'DESC')->get();
        $galeria = Galeria::findOrFail($id);
        $imagenes = Multimedia::where('galeria_id', $id)->orderBy('orden', 'asc')->get();
        return view('eunomia.galerias.form_edit_galerias', compact('idiomas', 'galeria', 'textos', 'imagenes', 'idiomas_imagenes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Galeria $galeria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$ordenar) {
            $idiomas = Idioma::where('activado', '1')->orderByDesc('principal')->get();

            foreach ($idiomas as $idioma) {
                if ($idioma->principal == 1)
                    $this->validate($request, [
                        'titulo' => 'required'
                    ]);
            }

            $galeria = Galeria::findOrFail($id);

            if ($galeria->save()) {

                for ($i = 0; $i < count($request->idioma_id); $i++) {
                    $textosIdioma = TextosIdioma::where('contenido_id', $id)
                        ->where('tipo_contenido_id', $this->tipo_contenido)
                        ->where('idioma_id', $request->idioma_id[$i])->first();
                    if (count($textosIdioma) == 0) {
                        $textosIdioma = new TextosIdioma();
                    }
                    if ($request->titulo[$i] != '') {
                        $textosIdioma->idioma_id = $request->idioma_id[$i];
                        $textosIdioma->contenido_id = $id;
                        $textosIdioma->tipo_contenido_id = $this->tipo_contenido;
                        $textosIdioma->titulo = $request->titulo[$i];
                        $textosIdioma->subtitulo = $request->subtitulo[$i];
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

            return redirect('eunomia/galerias');
        } else {
            $list_order = $request->list_order;
            $list = explode(',', $list_order);
            $i = 1;
            foreach ($list as $item_id) {
                if ($itemToOrder = Multimedia::findOrFail($item_id)) {
                    $itemToOrder->orden = $i;
                    $itemToOrder->save();
                }
                $i++;
            }
        }
    }

    function updateOrder(Request $request)
    {
        $list_order = $request->list_order;
        $list = explode(',', $list_order);
        $i = 1;
        foreach ($list as $item_id) {
            if ($itemToOrder = Multimedia::findOrFail($item_id)) {
                $itemToOrder->orden = $i;
                $itemToOrder->save();
            }
            $i++;
        }
    }

    public function updateTextoImagen(Request $request){
        $textosIdioma = TextosIdioma::where('contenido_id',$request->id)
            ->where('idioma_id',$request->idioma)
            ->where('tipo_contenido_id','7')->first();
        if (count($textosIdioma) == 0) {
            $textosIdioma = new TextosIdioma();
            $textosIdioma->tipo_contenido_id = '7';
        }
        $textosIdioma->idioma_id = $request->idioma;
        $textosIdioma->contenido_id = $request->id;
        $textosIdioma->titulo = $request->titulo;

        $textosIdioma->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Galeria  $galeria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->galeria_id > 0) {
            $multimedia = Multimedia::findOrfail($request->imagen_id);
            //Sacamos la carpeta de las imágenes de la tabla galerias
            $galeria = Galeria::findOrFail($request->galeria_id);
            //Eliminamos las imagenes
            $imagenactual = $multimedia->imagen;
            File::delete('images/galerias/' . $galeria->carpeta . '/' . $imagenactual);
            File::delete('images/galerias/' . $galeria->carpeta . '/th/' . $imagenactual);
            //Eliminamos la entrada del contenido
            $multimedia->delete();
            return redirect()->route('galerias.edit',['id' => $request->galeria_id]);
        } else {
            $galeria = Galeria::findOrFail($request->id);
            $multimedia = Multimedia::where('galeria_id',$request->id)->get();
            foreach ($multimedia as $imagen) {
                //Eliminamos la imagen
                $imagenactual = $imagen->imagen;
                File::delete('images/galerias/' . $galeria->carpeta . '/' . $imagenactual);
                //Eliminamos el registro
                $imagen->delete();
            }
            //Eliminamos la carpeta
            File::deleteDirectory('images/galerias/' . $galeria->carpeta . '/');
            //Eliminamos los textos en los idiomas
            $textosIdioma = TextosIdioma::where('contenido_id', $request->id)
                ->where('tipo_contenido_id', $this->tipo_contenido);
            $textosIdioma->delete();
            //Eliminamos el registro de galeria
            $galeria->delete();

            return redirect('eunomia/galerias');
        }
    }
}
