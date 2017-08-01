<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\Idioma;

class Menu extends Model
{

    // Recursive function that builds the menu from an array or object of items
    // In a perfect world some parts of this function would be in a custom Macro or a View
    public function buildMenu($menu, $parentid = 0)
    {
        $result = null;
        foreach ($menu as $item)
            if ($item->parent_id == $parentid) {
                $result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
	      <div class='dd-handle nested-list-handle'>
	        <span class='glyphicon glyphicon-move'></span>
	      </div>
	      <div class='nested-list-content'>{$item->label}
	        <div class='pull-right'>
	          <a href='" . url("eunomia/menu/edit/{$item->id}") . "'>Editar</a> |
	          <a href='#' class='delete_toggle' rel='{$item->id}'>Eliminar</a>
	        </div>
	      </div>" . $this->buildMenu($menu, $item->id) . "</li>";
            }
        return $result ? "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
    }

    // Getter for the HTML menu builder
    public function getHTML($items)
    {
        return $this->buildMenu($items);
    }

    public function textos_idioma(){
        return $this->belongsTo('App\TextosIdioma','id','contenido_id')->where('visible','1')->where('idioma_id',Idioma::fromCodigo(Session::get('idioma')))->where('tipo_contenido_id','6');
    }

    public function content(){
        return $this->belongsTo('App\Content','content_id','id');
    }

    public function submenu()
    {
        return $this->hasMany('App\Menu', 'parent_id')->orderBy('order', 'asc');
    }

}

