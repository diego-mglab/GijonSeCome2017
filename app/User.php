<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Rol;
use App\RolesUsuario;
use App\Permission;
use App\PermissionsUsuario;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles_usuario()
    {
        return $this->belongsTo('App\RolesUsuario', 'id', 'user_id')->where('user_id', $this->id);
    }

    public function isRole($role)
    {
        $rol = Rol::where('slug',$role)->first();
        if (is_object($rol)){
            $isrol = RolesUsuario::where('role_id',$rol->id)->where('user_id',$this->id)->first();
            if (isset($isrol->id)){
                return true;
            }
        }
        return false;
    }

    public function isPermission($permission)
    {
        $permiso = Permission::where('slug',$permission)->first();
        if (is_object($permiso)){
            $ispermission = PermissionsUsuario::where('permission_id',$permiso->id)->where('user_id',$this->id)->first();
            if (isset($ispermission->id)){
                return true;
            }
        }
        return false;
    }

    public function compruebaSeguridad($permission){
        $permiso = Permission::where('slug',$permission)->first();
        if (is_object($permiso)) {
            //Comprobamos primero si este permiso está activo en alguno de los roles asignados al usuario
            $rolesUsuario = RolesUsuario::where('user_id', $this->id)->get();
            foreach ($rolesUsuario as $rolUsuario) {
                $permissionRol = PermissionRole::where('permission_id',$permiso->id)->where('role_id',$rolUsuario->role_id)->first();
                if (isset($permissionRol->id)) {
                    return true;
                }
            }
            //Comprobamos si el permiso está asignado directamente al usuario
            $permissionUser = PermissionsUsuario::where('user_id',$this->id)->where('permission_id',$permiso->id)->first();
            if (isset($permissionUser->id)){
                return true;
            }
        }
        return false;
    }

    /**
     * Comprueba si el usuario tiene permiso de mostrar el módulo asignado al elemento de menú ($modulo).
     * @param $modulo
     */
    public function compruebaSeguridadMenu($modulo){
        //Buscamos el permiso de tipo mostrar asignado al módulo que nos llega en la función
        $permiso = Permission::where('model',$modulo)->where('permission_type','mostrar')->first();
        if (is_object($permiso)){
            //Comprobamos primero si este permiso está activo en alguno de los roles asignados al usuario
            $rolesUsuario = RolesUsuario::where('user_id', $this->id)->get();
            foreach ($rolesUsuario as $rolUsuario) {
                $permissionRol = PermissionRole::where('permission_id',$permiso->id)->where('role_id',$rolUsuario->role_id)->first();
                if (isset($permissionRol->id)) {
                    return true;
                }
            }
            //Comprobamos si el permiso está asignado directamente al usuario
            $permissionUser = PermissionsUsuario::where('user_id',$this->id)->where('permission_id',$permiso->id)->first();
            if (isset($permissionUser->id)){
                return true;
            }
        }
        return false;
    }
}
