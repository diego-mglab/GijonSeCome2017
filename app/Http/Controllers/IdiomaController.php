<?php

namespace App\Http\Controllers;

use App\Idioma;
use Image;
use Storage;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->compruebaSeguridad('mostrar-idiomas') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $idiomas=Idioma::all();
        return view('eunomia.idiomas.listado_idiomas',compact('idiomas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->compruebaSeguridad('crear-idioma') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        return view('eunomia.idiomas.form_ins_idiomas');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->compruebaSeguridad('crear-idioma') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $this->validate($request, [
            'idioma' => 'required',
            'codigo' => 'required'
        ]);

        $idioma = new Idioma();

        if($request->hasFile('imagen')) {

            $imagen = $request->file('imagen');

            $filename = $request->codigo . '.' . $imagen->getClientOriginalExtension();

            Image::make($imagen)->fit(21, 14, function ($constraint) {
                $constraint->upsize();
            })->save('images/idiomas/'.$filename );       }

        //Inserción de campos
        $idioma->imagen = $filename;
        $idioma->idioma = $request->idioma;
        $idioma->codigo = $request->codigo;
        if ($request->principal == 1) {
            $this->eliminarPrincipal();
            $idioma->principal = 1;
            $idioma->activado = 1;
        } else {
            $idioma->principal = 0;
            $idioma->activado = $request->activado;
        }

        $idioma->save();

        return redirect('eunomia/idiomas');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function show(Idioma $idioma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::user()->compruebaSeguridad('editar-idioma') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $idioma = Idioma::findOrFail($id);
        return view('eunomia.idiomas.form_edit_idiomas',compact('idioma'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::user()->compruebaSeguridad('editar-idioma') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $idioma = Idioma::findOrFail($id);
        $imagenactual = $idioma->imagen;

        if ($request->hasFile('imagen')) {

            File::delete('images/idiomas/' . $imagenactual);
            $imagen = $request->file('imagen');

            $filename = time() . '.' . $imagen->getClientOriginalExtension();


            Image::make($imagen)->fit(21, 14, function ($constraint) {
                $constraint->upsize();
            })->save('images/idiomas/' . $filename);

            $idioma->imagen = $filename;
        }

        $idioma->idioma = $request->idioma;
        $idioma->codigo = $request->codigo;

        if ($request->principal == 1) {
            $this->eliminarPrincipal();
            $idioma->principal = 1;
            $idioma->activado = 1;
        } else {
            $idioma->principal = 0;
            $idioma->activado = $request->activado;
        }

        $idioma->save();
        return redirect('eunomia/idiomas');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->compruebaSeguridad('eliminar-idioma') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $idioma = Idioma::findOrFail($id);
        $imagenactual = $idioma->imagen;
        File::delete('images/idiomas/'.$imagenactual);
        $idioma->delete();
        return redirect('eunomia/idiomas');
    }


    private function eliminarPrincipal()
    {
        $num = DB::update("update idiomas set principal = 0");
    }
}
