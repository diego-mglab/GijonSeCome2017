<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Configuracion extends Model
{
    protected $table = 'configuracion';

    protected $tipo_contenido = 9;

    public function textos_idioma()
    {
        return $this->belongsTo('App\TextosIdioma', 'id', 'contenido_id')->where('visible', '1')->where('idioma_id', Idioma::fromCodigo(Session::get('idioma')))->where('tipo_contenido_id', $this->tipo_contenido);
    }

}
