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
    
    public function index(){
        $authUrl = $this->client->createAuthUrl();
        return view('view::homepage', compact('authUrl'));
    }
    
    public function testConnection(){
        $this->client->setApplicationName($this->config['application_name']);
        $this->client->setClientId('');
        $this->client->setClientSecret('');
        $this->client->setRedirectUri('http://localhost:8000');
        $this->client->setDeveloperKey('');
        $this->client->setAccessType("offline");
        $this->client->addScope("https://www.googleapis.com/auth/userinfo.email");
        
        $authService = new \Google_Service_Oauth2($this->client);
        
        $this->autenticate($_GET['code']);
        $this->setTokenOfSession(session('access_token'));
        
        $userData = $this->getUserData($authService);

        return view('view::homepage', compact('userData', 'authUrl'));
    }
    
    public function autenticate($code){
        if(isset($code)){
            $this->client->authenticate($code);
            session(['access_token' => $this->client->getAccessToken()]);
            return redirect($this->config['redirect_url']);
        }
    }
    
    public function setTokenOfSession($session){
        $this->client->setAccessToken($session);
       
    }
    
    public function getUserData($authService){
        return $authService->userinfo->get()['email'];
    }
    
    public function getRequest($request){
        return $request;
    }
    
}