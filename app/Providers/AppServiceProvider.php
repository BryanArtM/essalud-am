<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        // Si no hay usuarios, creamos el admin inicial
        if (User::count() === 0) {
            User::create([
                'name' => env('ADMIN_NAME', 'Administrador'),
                'email' => env('ADMIN_EMAIL', 'admin@essalud.pe'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'admin123')),
            ]);
        }
    }

}