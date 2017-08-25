<?php

namespace App\Http\Controllers;

use App\MenuAdmin;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yaml;

class MenuAdminController extends Controller
{
    public function getIndex()
    {
        $items 	= MenuAdmin::orderBy('order')->get();

        $menu 	= new MenuAdmin;
        $menu   = $menu->getHTML($items);

        $icons = Yaml::parse(file_get_contents('https://rawgit.com/FortAwesome/Font-Awesome/master/src/icons.yml'));

        $tables = DB::select('SHOW TABLES');
        //dd($tables);

        //dd($icons);

        return view('eunomia.menu_admin.builder', compact('items','menu','icons','tables'));
    }

    public function getEdit($id)
    {
        $item = MenuAdmin::findOrFail($id);

        $icons = Yaml::parse(file_get_contents('https://rawgit.com/FortAwesome/Font-Awesome/master/src/icons.yml'));

        $tables = DB::select('SHOW TABLES');

        return view('eunomia.menu_admin.edit', compact('item','icons','tables'));
    }

    public function postEdit(Request $request)
    {
        $item = MenuAdmin::find($request->id);
        $item->title 	    = $request->title;
        $item->label        = $request->title;
        $item->icon         = $request->icon;
        $item->label_color  = $request->label_color;

        $item->url = $request->url;
        $item->table = $request->table;

        if ($request->separator == 1)
            $item->separator = 1;
        else
            $item->separator = 0;

        if ($request->visible == 1)
            $item->visible = 1;
        else
            $item->visible = 0;

        $item->save();

        return redirect("eunomia/menu_admin");
    }

    // AJAX Reordering function
    public function postIndex(Request $request)
    {
        //$source       = e(Input::get('source'));
        //$destination  = e(Input::get('destination',0));
        $source = $request->source;
        $destination = $request->destination;

        $item             = MenuAdmin::findOrFail($source);
        $item->parent_id  = $destination;
        $item->save();

        //$ordering       = json_decode(Input::get('order'));
        //$rootOrdering   = json_decode(Input::get('rootOrder'));

        $ordering       = json_decode($request->order);
        $rootOrdering   = json_decode($request->rootOrder);

        if($ordering){
            foreach($ordering as $order=>$item_id){
                if($itemToOrder = MenuAdmin::findOrFail($item_id)){
                    $itemToOrder->order = $order;
                    $itemToOrder->save();
                }
            }
        } else {
            foreach($rootOrdering as $order=>$item_id){
                if($itemToOrder = MenuAdmin::findOrFail($item_id)){
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
        $item = new MenuAdmin;

        $item->title 	    = $request->title;
        $item->label        = $request->title;
        $item->icon         = $request->icon;
        $item->label_color  = $request->label_color;

        $item->url = $request->url;
        $item->order 	= MenuAdmin::max('order')+1;
        $item->table = $request->table;

        if ($request->separator == 1)
            $item->separator = 1;
        else
            $item->separator = 0;

        if ($request->visible == 1)
            $item->visible = 1;
        else
            $item->visible = 0;

        $item->save();

        return redirect('eunomia/menu_admin');
    }

    public function postDelete(Request $request)
    {
        $id = $request->delete_id;
        // Find all items with the parent_id of this one and reset the parent_id to zero
        $items = MenuAdmin::where('parent_id', $id)->get()->each(function($item)
        {
            $item->parent_id = 0;
            $item->save();
        });

        // Find and delete the item that the user requested to be deleted
        $item = MenuAdmin::findOrFail($id);
        $item->delete();

        return redirect('eunomia/menu_admin');
    }
}
