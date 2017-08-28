<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Modulo;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('eunomia.permisos.listado_permisos', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modulos = Modulo::all()->pluck('nombre','id');
        return view('eunomia.permisos.form_ins_permisos',compact('modulos'));
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
            'name' => 'required',
            'slug' => 'required'
        ]);

        $permission = new Permission();

        $permission->name = $request->name;
        $permission->slug = $request->slug;
        $permission->model = $request->model;
        $permission->description = $request->description;

        $permission->save();

        return redirect('eunomia/permisos');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $modulos = Modulo::all()->pluck('nombre','id');
        return view('eunomia.permisos.form_edit_permisos',compact('permission','modulos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required'
        ]);

        $permission = Permission::findOrFail($id);

        $permission->name = $request->name;
        $permission->slug = $request->slug;
        $permission->model = $request->model;
        $permission->description = $request->description;

        $permission->save();

        return redirect('eunomia/permisos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect('eunomia/permisos');
    }
}
