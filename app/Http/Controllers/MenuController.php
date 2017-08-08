<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Idioma;
use App\TextosIdioma;
use Illuminate\Support\Facades\DB;
use App\Content;



class MenuController extends Controller {

	protected $layout = 'layout';
    protected $tipo_contenido = 6; // 1 - Contenido, 2 - Agenda, 3 - Ponente, 4 - Portada, 5 - Galería, 6 - Menú, 7 - Multimedia

	public function getIndex()
	{	
		$items 	= Menu::orderBy('order')->get();

		$menu 	= new Menu;
		$menu   = $menu->getHTML($items);

        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();

        $paginas = DB::table('contents')
            ->join('textos_idiomas','contents.id','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('contents.id','titulo','visible','principal','idioma','textos_idiomas.idioma_id')
            ->where('idiomas.principal',1)
            ->where('tipo_contenido_id',1)
            ->OrderBy('textos_idiomas.titulo')->pluck('titulo','contents.id');

		return view('eunomia.menu.builder', compact('items','menu','idiomas','paginas'));

		//$this->layout->content = View::make('eunomia.menu.builder', array('items'=>$items,'menu'=>$menu));
	}

	public function getEdit($id)
	{
        $idiomas = Idioma::where('activado','1')->orderBy('principal')->get();
        $textos = DB::table('menus')
            ->join('textos_idiomas','menus.id','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('menus.id','order','parent_id','url','titulo','visible','principal','idioma','textos_idiomas.idioma_id')
            ->where('tipo_contenido_id',$this->tipo_contenido)
            ->where('menus.id',$id)
            ->orderBy('principal','DESC')->get();
        $item = Menu::findOrFail($id);

        $paginas = DB::table('contents')
            ->join('textos_idiomas','contents.id','textos_idiomas.contenido_id')
            ->join('idiomas','textos_idiomas.idioma_id','idiomas.id')
            ->select('contents.id','titulo','visible','principal','idioma','textos_idiomas.idioma_id')
            ->where('idiomas.principal',1)
            ->where('tipo_contenido_id',1)
            ->OrderBy('textos_idiomas.titulo')->pluck('titulo','contents.id');

        return view('eunomia.menu.edit', compact('item','textos','idiomas','paginas'));
	}

	public function postEdit(Request $request)
	{
		$item = Menu::find($request->id);
        $item->title 	= $request->title;
        $item->label    = $request->title;

        $item->content_id = null;
        $item->url = null;
        if ($request->sel_link == '1') {
            $item->content_id = $request->content_id;
        } elseif ($request->sel_link == '2') {
            $item->url = $request->url;
        }
        if (isset($request->menu_pie))
            $item->menu_pie 	= $request->menu_pie;

        if($item->save()) {

            // TextosIdioma
            for($i=0;$i<count($request->idioma_id);$i++) {
                $textosIdioma = TextosIdioma::where('contenido_id',$request->id)
                    ->where('tipo_contenido_id',$this->tipo_contenido)
                    ->where('idioma_id',$request->idioma_id[$i])->first();
                if (count($textosIdioma) == 0) {
                    $textosIdioma = new TextosIdioma();
                }
                if ($request->label[$i] != '') {
                    $textosIdioma->idioma_id = $request->idioma_id[$i];
                    $textosIdioma->contenido_id = $request->id;
                    $textosIdioma->tipo_contenido_id = $this->tipo_contenido;
                    $textosIdioma->titulo = $request->label[$i];
                    $textosIdioma->visible = 0;
                    foreach($request->visible as $visible) {
                        if ($visible == $request->idioma_id[$i])
                            $textosIdioma->visible = 1;
                    }

                    $textosIdioma->save();
                }
            }

        }
		return redirect("eunomia/menu");
	}

	// AJAX Reordering function
	public function postIndex(Request $request)
	{	
	    //$source       = e(Input::get('source'));
	    //$destination  = e(Input::get('destination',0));
        $source = $request->source;
        $destination = $request->destination;

	    $item             = Menu::findOrFail($source);
	    $item->parent_id  = $destination;  
	    $item->save();

        //$ordering       = json_decode(Input::get('order'));
	    //$rootOrdering   = json_decode(Input::get('rootOrder'));

        $ordering       = json_decode($request->order);
        $rootOrdering   = json_decode($request->rootOrder);

        if($ordering){
	      foreach($ordering as $order=>$item_id){
	        if($itemToOrder = Menu::findOrFail($item_id)){
	            $itemToOrder->order = $order;
	            $itemToOrder->save();
	        }
	      }
	    } else {
	      foreach($rootOrdering as $order=>$item_id){
	        if($itemToOrder = Menu::findOrFail($item_id)){
	            $itemToOrder->order = $order;
	            $itemToOrder->save();
	        }
	      }
	    }

	    return 'ok ';
	}

	public function postNew(Request $request)
    {
        // Create a new menu item and save it
        $item = new Menu;

        $item->title = $request->title;
        $item->label = $request->title;
        $item->content_id = null;
        $item->url = null;
        if ($request->sel_link == '1') {
            $item->content_id = $request->content_id;
        } elseif ($request->sel_link == '2') {
            $item->url = $request->url;
        }
		$item->order 	= Menu::max('order')+1;
        if (isset($request->menu_pie))
		    $item->menu_pie 	= $request->menu_pie;
        else
            $item->menu_pie = '0';

		if($item->save()) {
            $lastId = $item->id;

            // TextosIdioma
            for($i=0;$i<count($request->idioma_id);$i++) {

                if ($request->label[$i] != '') {
                    $textosIdioma = new TextosIdioma();
                    $textosIdioma->idioma_id = $request->idioma_id[$i];
                    $textosIdioma->contenido_id = $lastId;
                    $textosIdioma->tipo_contenido_id = $this->tipo_contenido;
                    $textosIdioma->titulo = $request->label[$i];
                    $textosIdioma->visible = 0;
                    foreach($request->visible as $visible) {
                        if ($visible == $request->idioma_id[$i])
                            $textosIdioma->visible = 1;
                    }

                    $textosIdioma->save();
                }
            }

        }

		return redirect('eunomia/menu');
	}

	public function postDelete(Request $request)
	{
		$id = $request->delete_id;
		// Find all items with the parent_id of this one and reset the parent_id to zero
		$items = Menu::where('parent_id', $id)->get()->each(function($item)
		{
			$item->parent_id = 0;  
			$item->save();  
		});

		// Find and delete the item that the user requested to be deleted
		$item = Menu::findOrFail($id);
		$item->delete();

		return redirect('eunomia/menu');
	}
}