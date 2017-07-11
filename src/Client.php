<?php

namespace GooglePlus;

use Illuminate\Support\Facades\Session;

class Client{
    
    public $config;
    
    private $client;
    
    public function __construct(){
        $this->config = require __DIR__ . '/config.php';
        $this->client = $this->connect();
        $this->authService = new \Google_Service_Oauth2($this->client);
    }
    
    public function connect(){
        $client = new \Google_Client();
        $client->setApplicationName($this->config['application_name']);
        $client->setClientId($this->config['client_id']);
        $client->setClientSecret($this->config['client_secret']);
        $client->setRedirectUri($this->config['redirect_url']);
        $client->setDeveloperKey($this->config['api_key']);
        $client->setAccessType("offline");
        $client->addScope("https://www.googleapis.com/auth/userinfo.email");
        return $client;
    }
    
    public function index(){
        
        $authUrl = $this->client->createAuthUrl();
        return view('view::homepage', compact('authUrl'));
    }
    
   
    public function afterRedirect(){
     
        if(isset($_GET['code'])){
            $this->client->authenticate($_GET['code']);
            return redirect($this->config['redirect_url']);
        }
        
        session()->put('access_token', $this->client->getAccessToken());
        
        
        if(session('access_token')){
            $this->client->setAccessToken(session('access_token'));
        }
        
        if($this->client->getAccessToken()){
            $userData = $this->authService->userinfo->get();

        }
      
        return view('view::homepage', compact('userData'));
    }
    
}