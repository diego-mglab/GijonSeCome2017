<?php

namespace App\Http\Controllers;

use App\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->compruebaSeguridad('mostrar-modulos') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $modulos = Modulo::all();
        return view('eunomia.modulos.listado_modulos', compact('modulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->compruebaSeguridad('crear-modulo') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        return view('eunomia.modulos.form_ins_modulos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->compruebaSeguridad('crear-modulo') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $this->validate($request, [
            'nombre' => 'required'
        ]);

        $modulo = new Modulo();

        $modulo->nombre = $request->nombre;
        $modulo->descripcion = $request->descripcion;

        $modulo->save();

        return redirect('eunomia/modulos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function show(Modulo $modulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::user()->compruebaSeguridad('editar-modulo') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $modulo = Modulo::findOrFail($id);
        return view('eunomia.modulos.form_edit_modulos',compact('modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::user()->compruebaSeguridad('editar-modulo') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $modulo = Modulo::findOrFail($id);

        $modulo->nombre=$request->nombre;
        $modulo->descripcion=$request->descripcion;
        $modulo->save();

        return redirect('eunomia/modulos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->compruebaSeguridad('eliminar-modulo') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $modulo = Modulo::findOrFail($id);
        $modulo->delete();

        return redirect('eunomia/modulos');
    }
}
