<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\ProductRepository\ProductEloquentRepository;
use App\Repositories\ProductRepository\ProductRepositoryInterface;
use App\Repositories\CategoryRepository\CategoryEloquentRepository;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Repositories\UserRepository\UserEloquentRepository;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Repositories\SupplierRepository\SupplierEloquentRepository;
use App\Repositories\SupplierRepository\SupplierRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductEloquentRepository::class
        );

        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryEloquentRepository::class
        );

        $this->app->singleton(
            UserRepositoryInterface::class,
            UserEloquentRepository::class
        );
        
        $this->app->singleton(
            SupplierRepositoryInterface::class,
            SupplierEloquentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
