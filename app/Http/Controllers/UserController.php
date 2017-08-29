<?php

namespace App\Http\Controllers;

use App\User;
use Hash;
use App\Rol;
use App\RolesUsuario;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->compruebaSeguridad('mostrar-usuarios') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $users = User::all();
        return view('eunomia.usuarios.listado_usuarios', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->compruebaSeguridad('crear-usuario') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $roles = Rol::get()->pluck('name','id');
        return view('eunomia.usuarios.form_ins_usuarios', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->compruebaSeguridad('crear-usuario') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new user;

        $user->name = $request->name;
        $user->email = $request->email;
        $password = Hash::make($request->password);
        $user->password = $password;

        if ($user->save()){
            $lastId = $user->id;
            //Roles
            $roles = $request->roles;
            if (isset($roles)) {
                foreach ($roles as $rol) {
                    $rolesUsuario = new RolesUsuario();
                    $rolesUsuario->role_id = $rol;
                    $rolesUsuario->user_id = $lastId;

                    $ponentesAgenda->save();
                }
            }
        }

        return redirect('eunomia/usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::user()->compruebaSeguridad('editar-usuario') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $user = User::findOrFail($id);
        $allroles = Rol::get()->pluck('name','id');
        $roles = RolesUsuario::where('user_id',$id)->pluck('role_id')->toArray();
        return view('eunomia.usuarios.form_edit_usuarios', compact('user','allroles','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::user()->compruebaSeguridad('editar-usuario') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $user = User::findOrFail($id);

        $user->name=$request->name;
        $user->email=$request->email;
        if($user->save()){
            // Eliminamos los roles del usuario para volver a insertar los nuevos
            RolesUsuario::where('user_id',$id)->delete();
            $roles = $request->roles;
            if (isset($roles)) {
                foreach ($roles as $rol) {
                    $rolesUsuario = new RolesUsuario();
                    $rolesUsuario->role_id = $rol;
                    $rolesUsuario->user_id = $id;

                    $rolesUsuario->save();
                }
            }

        }

        return redirect('eunomia/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->compruebaSeguridad('eliminar-usuario') == false)
            return view('eunomia.mensajes.mensaje_error')->with('msj','..no tiene permisos para acceder a esta sección');
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('eunomia/usuarios');
    }
}
