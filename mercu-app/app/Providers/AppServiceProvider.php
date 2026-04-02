<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Daftarkan komponen layout secara manual
        Blade::component('layouts.guest', 'guest-layout');
        Blade::component('layouts.app', 'app-layout');
    }
}
