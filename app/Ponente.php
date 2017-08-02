<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\Idioma;

class Ponente extends Model
{
    public function textos_idioma(){
        return $this->belongsTo('App\TextosIdioma','id','contenido_id')->where('visible','1')->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->where('tipo_contenido_id','3');
    }

    public function ponentesAgenda(){
        return $this->hasMany('App\PonentesAgenda','ponente_id','id');
    }

}
