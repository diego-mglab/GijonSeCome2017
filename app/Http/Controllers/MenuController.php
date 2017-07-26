<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class MenuController extends Controller {

	protected $layout = 'layout';

	public function getIndex()
	{	
		$items 	= Menu::orderBy('order')->get();

		$menu 	= new Menu;
		$menu   = $menu->getHTML($items);

		return view('eunomia.menu.builder', compact('items','menu'));

		//$this->layout->content = View::make('eunomia.menu.builder', array('items'=>$items,'menu'=>$menu));
	}

	public function getEdit($id)
	{	
		$item = Menu::findOrFail($id);
        return view('eunomia.menu.edit', compact('item'));
		//$this->layout->content = View::make('eunomia.menu.edit', array('item'=>$item));
	}

	public function postEdit(Request $request)
	{	
		$item = Menu::find($request->id);
        $item->title 	= $request->title;
        $item->label 	= $request->label;
        $item->url 		= $request->url;

		$item->save();
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

		$item->title 	= $request->title;
		$item->label 	= $request->label;
		$item->url 		= $request->url;
		$item->order 	= Menu::max('order')+1;

		$item->save();

		return redirect('eunomia/menu');
	}

	public function postDelete()
	{
		$id = Request::get('delete_id');
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