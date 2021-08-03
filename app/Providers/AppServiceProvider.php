<?php

namespace App\Providers;

use App\Log;
use App\Observers\LogObserver;
use App\Observers\ProductObserver;
use App\Product;
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
        Log::observe(LogObserver::class);
        Product::observe(ProductObserver::class);
    }
}
