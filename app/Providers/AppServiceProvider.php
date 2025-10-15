<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void 
    {
        // Gate para admin (usa tu rol "administrador")
        Gate::define('admin', function ($user) {
            return $user->hasRole('administrador');
        });

        // Otros permisos existentes
        Gate::define('edit-name', function ($user) {
            return $user->hasRole('administrador');
        });
    }
}
