<?php

namespace App\Http\Controllers;

use App\Zona;
use Illuminate\Http\Request;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->compruebaSeguridad('mostrar-zonas') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $zonas = Zona::all();
        return view('eunomia.zonas.listado_zonas', compact('zonas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->compruebaSeguridad('crear-zona') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        return view('eunomia.zonas.form_ins_zonas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->compruebaSeguridad('crear-zona') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $this->validate($request, [
            'nombre' => 'required',
            'color' => 'required'
        ]);

        $zona = new Zona();

        //Inserción de campos
        $zona->nombre = $request->nombre;
        $zona->color = $request->color;

        $zona->save();

        return redirect('eunomia/zonas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function show(Zona $zona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::user()->compruebaSeguridad('editar-zona') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $zona = Zona::findOrFail($id);
        return view('eunomia.zonas.form_edit_zonas',compact('zona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::user()->compruebaSeguridad('editar-zona') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $zona = Zona::findOrFail($id);

        $zona->nombre = $request->nombre;
        $zona->color = $request->color;


        $zona->save();
        return redirect('eunomia/zonas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->compruebaSeguridad('eliminar-zona') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $zona = Zona::findOrFail($id);
        $zona->delete();

        return redirect('eunomia/zonas');
    }
}
