<?php

namespace App\Providers;

use App\Models\Product;
use App\Service\ProductService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        $this->app->bind(ProductService::class, function ($app) {
            return new ProductService($app->make(Product::class));
        });
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
    }
}
