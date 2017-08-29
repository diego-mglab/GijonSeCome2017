<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\DB;
use App\MenuAdmin;

class AppServiceProvider extends ServiceProvider
{
    protected $carpeta_admin = 'eunomia'.'/';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $elements = MenuAdmin::orderBy('order')->get();
            foreach($elements as $element) {
                if ($element->separator)
                    $event->menu->add(strtoupper($element->label));
                else {
                    if ($element->table != ''){
                        $label = DB::table($element->table)->count();
                    } else
                        $label='';
                        $event->menu->add([
                            'text' => $element->label,
                            'url' => $this->carpeta_admin . $element->url,
                            'icon' => $element->icon,
                            'label_color' => str_replace('#','',$element->label_color),
                            'label' => $label,
                        ]);
                }
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
