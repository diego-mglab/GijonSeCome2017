<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\Idioma;

class Portada extends Model
{
    protected $table='portada';

    protected $tipo_contenido = 4; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada, 5 - Galería, 6 - Menú, 7 - Multimedia, 8 - Documentos Prensa, 9 - Configuracion

    public function textos_idioma(){
        return $this->belongsTo('App\TextosIdioma','id','contenido_id')->where('visible','1')->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->where('tipo_contenido_id',$this->tipo_contenido);
    }

    public function textos_idioma_principal(){
        return $this->belongsTo('App\TextosIdioma','id','contenido_id')->where('visible','1')->where('idioma_id',Idioma::where('principal',1)->first()->id)->where('tipo_contenido_id',$this->tipo_contenido);
    }

    public function contenido(){
        return $this->belongsTo('App\Content','contenido_id','id');
    }
}
