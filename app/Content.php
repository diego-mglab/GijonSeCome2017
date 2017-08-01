<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Content extends Model
{
    public function textos_idioma(){
        return $this->belongsTo('App\TextosIdioma','id','contenido_id')->where('visible','1')->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->where('tipo_contenido_id','1');
    }

    public function textos_idioma_principal(){
        return $this->belongsTo('App\TextosIdioma','id','contenido_id')->where('visible','1')->where('idioma_id',Idioma::where('principal',1)->first()->id)->where('tipo_contenido_id','1');
    }

    public function textos_idioma_todos($idioma_id){
        return TextosIdioma::where('idioma_id',$idioma_id)->where('id',$this->id)->first();
    }

    public function menu(){
        return $this->hasMany('App\Menu','id','content_id');
    }
}
