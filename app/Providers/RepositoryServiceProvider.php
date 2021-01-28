<?php

namespace App\Providers;

use App\Repositories\Core\QueryBuilder\QueryBuilderProductRepository;
use App\Repositories\Contracts\{CategoryRepositoryInterface, ProductRepositoryInterface};
use App\Repositories\Core\Eloquent\{EloquentCategoryRepository, EloquentProductRepository};
use App\Repositories\Core\QueryBuilder\QueryBuilderCategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->singleton(CategoryRepositoryInterface::class, QueryBuilderCategoryRepository::class);
//        $this->app->singleton(CategoryRepositoryInterface::class, EloquentCategoryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
