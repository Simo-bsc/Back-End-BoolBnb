<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Apartment;

use Braintree_Configuration;

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
    public function boot()
    {
        // Retrieve all apartments from the database
        $apartments = Apartment::all();

        // Share the $apartments variable with all views
        View::share('apartments', $apartments);

    }
}
