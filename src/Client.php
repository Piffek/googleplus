<?php

namespace GooglePlus;

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
    
    public function afterRedirect(){
        $userData = $this->getUserData($this->authService);
    }
    
    public function getUserData($authService){
        return $authService->userinfo->get();
    }
    
    public function getRequest($request){
        return $request;
    }
    
}