<?php

namespace App\Providers;

use App\View\Components\Badge;
use App\View\Components\Card;
use Illuminate\Support\Facades\Blade;
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
        Blade::component('components.badge', 'badge');
        Blade::component('components.updated', 'updated');
        Blade::component(Card::class, 'card');
    }
}
