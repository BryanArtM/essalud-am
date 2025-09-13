<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
        protected $policies = [
    ];

        public function boot(): void
    {
        $this->registerPolicies();
        //Los administradores pueden gestionar usuarios
        Gate::define('manage-users', function ($user) {
            return $user->is_admin == 1;

        });
    }
}
