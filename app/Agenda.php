<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Agenda extends Model
{
    protected $table = 'agenda';

    protected $tipo_contenido = 2;

    public function textos_idioma(){
        return $this->belongsTo('App\TextosIdioma','id','contenido_id')->where('visible','1')->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->where('tipo_contenido_id',$this->tipo_contenido);
    }

    public function ponentesAgenda(){
        return $this->hasMany('App\PonentesAgenda','agenda_id','id');
    }

    public function zona() {
        return $this->belongsTo('App\Zona','zona_id','id');
    }
}
