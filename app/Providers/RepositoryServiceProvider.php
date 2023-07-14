<?php

namespace App\Providers;

use App\Interfaces\CategoryInterface;
use App\Interfaces\ItemInterface;
use App\Interfaces\ItemUploadInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\ItemRepository;
use App\Repositories\ItemUploadRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        ItemInterface::class => ItemRepository::class,
        CategoryInterface::class => CategoryRepository::class, 
        ItemUploadInterface::class => ItemUploadRepository::class,        

    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ItemInterface::class, ItemRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(ItemUploadInterface::class, ItemUploadRepository::class);


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
