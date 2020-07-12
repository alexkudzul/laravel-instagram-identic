<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // ------CONFIGURACION DE CARBON EN ESPANIOL----------
        /**
         * utf8, configura la codificación de caracteres, si la DB devulve una tilde o ñ, lo devolvera en formato castellano
        */
        Carbon::setlocale('es');
        Carbon::setUtf8('true');
        setlocale(LC_TIME, 'es_ES');
    }
}
