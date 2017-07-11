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
    
    public function testConnection(){
        $this->client->setApplicationName($this->config['application_name']);
        $this->client->setClientId('624703367819-p617jf75bj2j9ouqafeqv8dklo1jc4fp.apps.googleusercontent.com');
        $this->client->setClientSecret('4hI5KfBu9AKbYQvT91SSsWkw');
        $this->client->setRedirectUri($this->config['redirect_url']);
        $this->client->setDeveloperKey('AIzaSyDPQWAdd2j1Yymfd2AH0G-6JHkvh6GeI8w');
        $this->client->addScope("https://www.googleapis.com/auth/userinfo.email");
        
        $authService = new \Google_Service_Oauth2($this->client);
        
        $userData = $this->getUserData($authService);
        return view('view::homepage', compact('userData'));
    }
    
    public function autenticate($code){
        if(isset($_GET['code'])){
            $this->client->authenticate($_GET['code']);
            session(['access_token' => $this->client->getAccessToken()]);
            return redirect($this->config['redirect_url']);
        }
    }
    
    public function setTokenOfSession(){
        $this->client->setAccessToken(session('access_token'));
       
    }
    
    public function getUserData($authService){
        return $authService->userinfo->get()['email'];
    }
    
    public function getRequest($request){
        return $request;
    }
    
}