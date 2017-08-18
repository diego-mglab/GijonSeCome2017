<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Idioma;
use Session;

class DocumentosPrensa extends Model
{
    protected $table = 'documentos_prensa';

    public function textos_idioma()
    {
        return $this->belongsTo('App\TextosIdioma', 'id', 'contenido_id')->where('visible', '1')->where('idioma_id', Idioma::fromCodigo(Session::get('idioma')))->where('tipo_contenido_id', '8');
    }

    public function textos_idioma_principal()
    {
        return $this->belongsTo('App\TextosIdioma', 'id', 'contenido_id')->where('visible', '1')->where('idioma_id', Idioma::where('principal', 1)->first()->id)->where('tipo_contenido_id', '8');
    }

}
