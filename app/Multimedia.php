<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\Idioma;

class Multimedia extends Model
{
    protected $table = 'multimedia';

    protected $tipo_contenido = 7; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada, 5 - Galería, 6 - Menú, 7 - Multimedia, 8 - Documentos Prensa, 9 - Configuracion

    public function galeria(){
        return $this->belongsTo('App\Galeria','galeria_id','id');
    }

    public function textos_idioma(){
        return $this->belongsTo('App\TextosIdioma','id','contenido_id')->where('visible','1')->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->where('tipo_contenido_id',$this->tipo_contenido);
    }

    public function textos_idioma_todos($codigo){
        $idioma_id = Idioma::fromCodigo($codigo);
        return TextosIdioma::where('idioma_id',$idioma_id)->where('contenido_id',$this->id)->where('tipo_contenido_id',$this->tipo_contenido)->first();
    }
}
