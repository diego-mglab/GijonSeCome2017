<?php

namespace Swatkins\LaravelGantt;

use Illuminate\Support\ServiceProvider;

class GanttServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/assets/css' => public_path('vendor/swatkins/gantt/css'),
        ], 'gantt');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
