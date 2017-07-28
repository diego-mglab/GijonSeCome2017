<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextosIdioma extends Model
{
    public function menu(){
        return $this->belongsTo('App\Menu', 'id','contenido_id');
    }

    public function idioma(){
        return $this->belongsToMany('App\Idioma','idioma_id','id');
    }

    public function portada(){
        return $this->belongsTo('App\Portada', 'id','contenido_id');
    }
}
