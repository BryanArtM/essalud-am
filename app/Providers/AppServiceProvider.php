<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;


class AppServiceProvider extends ServiceProvider
{
        public function register(): void
    {
        //
    }

    
    public function boot(): void
    {
    // Forzar idioma español
        App::setLocale('es');
    }

}