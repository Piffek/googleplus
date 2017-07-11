<?php

namespace GooglePlus;

use Google_Service_Drive;


class Client{
    
    public $config;
    
    private $client;
    
    public function __construct(){
        $this->config = require __DIR__ . '/config.php';
        $this->client = new \Google_Client();
    }
    
    private function curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
        curl_close($ch);
    }
    
    public function testConnection(){
        $this->client->setClientId($this->config['user_id']);
        $this->client->setClientSecret($this->config['user_secret']);
        $this->client->setRedirectUri($this->client['redirect_url']);
        $this->client->setScopes('email');
        


    }
    
    public function redirect(){
        $this->client->createAuthUrl();
    }
}