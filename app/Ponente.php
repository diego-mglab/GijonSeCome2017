<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\Idioma;

class Ponente extends Model
{
    protected $tipo_contenido = 3; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada, 5 - Galería, 6 - Menú, 7 - Multimedia, 8 - Documentos Prensa, 9 - Configuracion

    public function textos_idioma(){
        return $this->belongsTo('App\TextosIdioma','id','contenido_id')->where('visible','1')->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->where('tipo_contenido_id',$this->tipo_contenido);
    }

    public function textos_idioma_principal()
    {
        return $this->belongsTo('App\TextosIdioma', 'id', 'contenido_id')->where('visible', '1')->where('idioma_id', Idioma::where('principal', 1)->first()->id)->where('tipo_contenido_id', $this->tipo_contenido);
    }

    public function ponentesAgenda(){
        return $this->hasMany('App\PonentesAgenda','ponente_id','id');
    }

    /**
     * Return sub string sin etiquetas HTML y puntos suspensivos al final
     * @param $string String
     * @param $length Largo que queremos el substring
     * @return String con ...
     */

    public function getSubString($texto, $numMaxCaract = NULL)
    {
        $texto = strip_tags($texto);
        if (strlen($texto) < $numMaxCaract) {
            $textoCortado = $texto;
        } else {
            $textoCortado = substr($texto, 0, $numMaxCaract);
            $ultimoEspacio = strripos($textoCortado, " ");

            if ($ultimoEspacio !== false) {
                $textoCortadoTmp = substr($textoCortado, 0, $ultimoEspacio);
                if (substr($textoCortado, $ultimoEspacio)) {
                    $textoCortadoTmp .= '...';
                }
                $textoCortado = $textoCortadoTmp;
            } elseif (substr($texto, $numMaxCaract)) {
                $textoCortado .= '...';
            }
        }

        return $textoCortado;
    }
}
