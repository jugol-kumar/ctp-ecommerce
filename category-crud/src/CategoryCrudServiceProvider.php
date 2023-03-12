<?php

namespace JugolKumar\CategoryCurd;

use Closure;
use Illuminate\Support\ServiceProvider;

class CategoryCrudServiceProvider extends ServiceProvider{

    /**
     *
     */
    public function register()
    {
        $this->app->bind('JugolCategory', function ($app){
            return new \JugolKumar\CategoryCurd\UniqueSlug();
        });

        $this->mergeConfigFrom(
            __DIR__.'./config/JugolCategory.php', 'JugolCategory'
        );
    }

    public function boot()
    {

        $this->publishes([
            __DIR__.'./config/JugolCategory.php' => config_path('JugolCategory.php'),
        ]);
    }

}



