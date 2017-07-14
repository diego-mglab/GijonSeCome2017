<?php

namespace App\Http\Controllers;

use App\Idioma;
use Image;
use Storage;
use File;
use Hash;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            $idioma->principal = 'Si';
        } else {
            $idioma->principal='No';
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
    public function update(Request $request, Idioma $idioma)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idioma $idioma)
    {
        //
    }


    private function eliminarPrincipal()
    {
        $num = DB::update("update idiomas set principal='No'");
    }
}
