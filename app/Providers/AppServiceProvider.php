<?php

namespace App\Providers;

use App\Enums\RoleType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Model::preventLazyLoading();
        Blade::if('development', fn() => app()->environment('local'));
        Blade::if('merchant', fn() => Auth::user()->role === RoleType::MERCHANT);
        Blade::if('customer', fn() => Auth::user()->role === RoleType::CUSTOMER);
    }
}
