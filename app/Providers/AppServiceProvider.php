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
            if (\Auth::user()->compruebaSeguridad('mostrar-elementos-menu-admin') == true){
                //Este nodo siempre se pinta si no se han definido permisos para poder crear la estructura del panel de control
                $event->menu->add('ADMIN');
                $event->menu->add([
                    'text' => 'Menú Administración',
                    'url' => $this->carpeta_admin . 'menu_admin',
                    'icon' => 'navicon',
                ]);
            }
            $elements = MenuAdmin::orderBy('order')->get();
            foreach($elements as $element) {
                if ($element->separator)
                    $event->menu->add(strtoupper($element->label));
                else {
                    if ($element->table != '')
                        $label = DB::table($element->table)->count();
                    else
                        $label = '';
                    if (\Auth::user()->compruebaSeguridadMenu($element->modulo_id)) {
                        $event->menu->add([
                            'text' => $element->label,
                            'url' => $this->carpeta_admin . $element->url,
                            'icon' => $element->icon,
                            'label_color' => str_replace('#', '', $element->label_color),
                            'label' => $label,
                        ]);
                    }
                }
            }
            //Añadimos los enlaces a la gestión de la cuenta del usuario (Perfil y cambio de contraseña)
            $event->menu->add([
                'text' => 'Profile',
                'url' => $this->carpeta_admin . 'usuarios/'.\Auth::user()->id.'/edit',
                'icon' => 'user',
            ]);
            $event->menu->add([
                'text' => 'Cambiar contraseña',
                'url' => $this->carpeta_admin . 'usuarios/password',
                'icon' => 'key',
            ]);
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
