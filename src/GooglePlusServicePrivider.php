<?php

namespace GooglePlus;

use Illuminate\Support\ServiceProvider;


class GooglePlusServiceProvider extends ServiceProvider{
    
    public function boot(){
        $this->loadRoutesFrom(__DIR__ . '/views/routes.php');
        $this->publishes([__DIR__ . '/config.php' => 'config.php']);
    }
    
    public function register(){ 
        $this->mergeConfigFrom(__DIR__ . '/config.php', 'google');
        $this->app->singleton('GooglePlus\GoogleClient\Client', function($app){
            return new Client();
        });
    }
    
}