<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Content extends Model
{
    protected $tipo_contenido = 1;

    public function textos_idioma()
    {
        return $this->belongsTo('App\TextosIdioma', 'id', 'contenido_id')->where('visible', '1')->where('idioma_id', Idioma::fromCodigo(Session::get('idioma')))->where('tipo_contenido_id', $this->tipo_contenido);
    }

    public function textos_idioma_principal()
    {
        return $this->belongsTo('App\TextosIdioma', 'id', 'contenido_id')->where('visible', '1')->where('idioma_id', Idioma::where('principal', 1)->first()->id)->where('tipo_contenido_id', $this->tipo_contenido);
    }

    public function textos_idioma_todos($idioma_id)
    {
        return TextosIdioma::where('idioma_id', $idioma_id)->where('contenido_id', $this->id)->where('tipo_contenido_id', $this->tipo_contenido)->first();
    }

    public function menu()
    {
        return $this->hasMany('App\Menu', 'id', 'content_id');
    }

    public function portada()
    {
        return $this->hasMany('App\Portada', 'id', 'contenido_id');
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