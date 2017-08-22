<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Illuminate\Support\Facades\DB;
use App\Idioma;

class Web extends Model
{
    /**
     * Devuelve el metatítulo y la metadescripción de cada página si la tienen asignada en la BBDD. Si no devuelve los datos estándar de la tabla configuración de la web
     * Recibe la tabla de la que hay que sacar los metas, la url amigable y el tipo de contenido // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada, 5 - Galería, 6 - Menú, 7 - Multimedia, 8 - Documentos Prensa, 9 - Configuracion
     *
     * @param  String $tabla, String $slug, Int $tipo_contenido
     * @return Array $metas
     */
    public static function devuelveMetas($tabla,$slug,$tipo_contenido){
        $meta = DB::table($tabla)
            ->join('textos_idiomas',$tabla.'.id','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('metatitulo','metadescripcion')
            ->where('slug',$slug)
            ->where('tipo_contenido_id',$tipo_contenido)
            ->where('textos_idiomas.idioma_id',Idioma::fromCodigo(Session::get('idioma')))->first();

        $meta_def = Configuracion::first();
        $metas = array();
        if (is_object($meta)){
            if ($meta->metatitulo!='' && !is_null($meta->metatitulo)) {
                $metas[0] = $meta->metatitulo;
            } else {
                $metas[0] = $meta_def->textos_idioma->metatitulo;
            }
            if ($meta->metadescripcion!='' && !is_null($meta->metadescripcion)) {
                $metas[1] = $meta->metadescripcion;
            } else {
                $metas[1] = $meta_def->textos_idioma->metadescripcion;
            }
        }else {
            $metas[0] = $meta_def->textos_idioma->metatitulo;
            $metas[1] = $meta_def->textos_idioma->metadescripcion;
        }
        return $metas;
    }
}
