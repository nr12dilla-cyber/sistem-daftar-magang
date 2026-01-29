<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Kita tidak perlu mengimport Paginator jika menggunakan standar Tailwind

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
        // Secara default Laravel sudah menggunakan Tailwind CSS.
        // Dengan mengosongkan ini, Laravel akan otomatis mencari class Tailwind 
        // yang cocok dengan dashboard kamu.
    }
}