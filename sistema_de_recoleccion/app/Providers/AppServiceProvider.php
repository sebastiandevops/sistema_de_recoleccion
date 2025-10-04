<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Collection;
use App\Policies\CollectionPolicy;

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
        // Register policies
        \Gate::policy(Collection::class, CollectionPolicy::class);

        //
    }
}
