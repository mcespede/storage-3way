<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormatTimeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //Cada vez que creamos un helper tenemos que modificar esto para que el Provider pueda cargar un servicio.
         require_once app_path() . '/Helpers/FormatTime.php';

    }
}
