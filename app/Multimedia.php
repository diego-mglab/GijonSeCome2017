<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Multimedia extends Model
{
    protected $table = 'multimedia';

    public function textos_idioma_todos($idioma_id){
        return TextosIdioma::where('idioma_id',$idioma_id)->where('contenido_id',$this->id)->where('tipo_contenido_id',7)->first();
    }
}
