<?php

namespace GooglePlus;

use Illuminate\Support\ServiceProvider;


class GooglePlusServiceProvider extends ServiceProvider{
    
    public function boot(){
        $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
        $this->publishes([__DIR__ . '/config.php' => 'config.php']);
        $this->loadViewsFrom(__DIR__ . '/views', 'view');
        $this->publishes([__DIR__ . '/config.php' => config_path('config.php')]);
    }
    
    public function register(){ 
        $this->mergeConfigFrom(__DIR__ . '/config.php', 'google');
        $this->app->singleton('GooglePlus\Client', function($app){
            return new Client();
        });
    }
    
}