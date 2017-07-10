<?php

namespace Przelewy24;

use Illuminate\Support\ServiceProvider;

class Przelewy24ServiceProvider extends ServiceProvider{
    
    public function boot(){
        $this->loadRoutesFrom(__DIR__ . '/views/routes.php');
        $this->publishes([__DIR__ . '/config.php' => 'config.php']);
    }
    
}