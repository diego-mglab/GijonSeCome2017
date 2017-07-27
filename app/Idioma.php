<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    public function textos_idioma(){
        return $this->belongsTo('App\TextosIdioma','id','idioma_id');
    }
}
