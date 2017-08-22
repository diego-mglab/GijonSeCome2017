<?php

namespace App\Http\Controllers;

use App\DocumentosPrensa;
use Illuminate\Http\Request;
use App\Idioma;
use Str;
use File;
use App\TextosIdioma;
use Illuminate\Support\Facades\DB;

class DocumentosPrensaController extends Controller
{
    protected $tipo_contenido = 8; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada, 5 - Galería, 6 - Menú, 7 - Multimedia, 8 - Documentos Prensa, 9 - Configuracion

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos_prensa=DocumentosPrensa::all();
        return view('eunomia.documentos_prensa.listado_documentos_prensa',compact('documentos_prensa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();
        return view('eunomia.documentos_prensa.form_ins_documentos_prensa',compact('idiomas'));
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

        $documentoPrensa = new DocumentosPrensa();


        if($request->hasFile('fichero')){

            $fichero = $request->file('fichero');

            $filename = $fichero->getClientOriginalName();


            $dir = 'prensa/';
            if (!File::exists($dir)){
                File::makeDirectory($dir);
            }

            \Storage::disk('ficheros')->put($filename,\File::get($fichero));

            $documentoPrensa->fichero = $filename;

        }

        if ($documentoPrensa->save()) {
            $lastId = $documentoPrensa->id;

            for($i=0;$i<count($request->idioma_id);$i++) {

                if ($request->titulo[$i] != '') {
                    $textosIdioma = new TextosIdioma();
                    $textosIdioma->idioma_id = $request->idioma_id[$i];
                    $textosIdioma->contenido_id = $lastId;
                    $textosIdioma->tipo_contenido_id = $this->tipo_contenido;
                    $textosIdioma->titulo = $request->titulo[$i];

                    $textosIdioma->save();
                }
            }

        }

        return redirect('eunomia/documentos_prensa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DocumentosPrensa  $documentosPrensa
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentosPrensa $documentosPrensa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DocumentosPrensa  $documentosPrensa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();
        $textos = DB::table('documentos_prensa')
            ->join('textos_idiomas','documentos_prensa.id','=','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('documentos_prensa.id as documentos_prensa_id','titulo','principal','idioma','idiomas.imagen','codigo','textos_idiomas.idioma_id')
            ->where('tipo_contenido_id',$this->tipo_contenido)
            ->where('documentos_prensa.id',$id)
            ->orderBy('principal','DESC')->get();
        $documentosPrensa = DocumentosPrensa::findOrFail($id);
        return view('eunomia.documentos_prensa.form_edit_documentos_prensa',compact('idiomas','documentosPrensa','textos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DocumentosPrensa  $documentosPrensa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();

        foreach ($idiomas as $idioma) {
            if ($idioma->principal == 1)
                $this->validate($request, [
                    'titulo' => 'required'
                ]);
        }

        $documentoPrensa = DocumentosPrensa::findOrFail($id);


        if($request->hasFile('fichero')){

            $ficheroactual = $documentoPrensa->fichero;

            $dir = 'files/prensa/';
            File::delete($dir.$ficheroactual);

            $fichero = $request->file('fichero');

            $filename = $fichero->getClientOriginalName();


            $dir = 'prensa/';
            if (!File::exists($dir)){
                File::makeDirectory($dir);
            }

            \Storage::disk('ficheros')->put($filename,\File::get($fichero));

            $documentoPrensa->fichero = $filename;

        }

        if ($documentoPrensa->save()) {

            for($i=0;$i<count($request->idioma_id);$i++) {
                $textosIdioma = TextosIdioma::where('contenido_id',$id)
                    ->where('tipo_contenido_id',$this->tipo_contenido)
                    ->where('idioma_id',$request->idioma_id[$i])->first();
                if (count($textosIdioma) == 0) {
                    $textosIdioma = new TextosIdioma();
                }
                if ($request->titulo[$i] != '') {
                    $textosIdioma->idioma_id = $request->idioma_id[$i];
                    $textosIdioma->contenido_id = $documentoPrensa->id;
                    $textosIdioma->tipo_contenido_id = $this->tipo_contenido;
                    $textosIdioma->titulo = $request->titulo[$i];

                    $textosIdioma->save();
                }
            }

        }

        return redirect('eunomia/documentos_prensa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentosPrensa  $documentosPrensa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $textosIdioma = TextosIdioma::where('contenido_id',$id)
            ->where('tipo_contenido_id',$this->tipo_contenido);
        $textosIdioma->delete();
        $documentoPrensa = DocumentosPrensa::findOrfail($id);
        $ficheroactual = $documentoPrensa->fichero;
        File::delete('files/prensa/'.$ficheroactual);
        $documentoPrensa->delete();
        return redirect('eunomia/documentos_prensa');
    }
}
