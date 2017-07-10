<?php

namespace GooglePlus;

use Illuminate\Support\ServiceProvider;

class GooglePlusServiceProvider extends ServiceProvider{
    
    public function boot(){
        $this->loadRoutesFrom(__DIR__ . '/views/routes.php');
        $this->publishes([__DIR__ . '/config.php' => 'config.php']);
    }
    
}