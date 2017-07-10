<?php

namespace Przelewy24\UrlGenerator;

class BaseUrl{
    
    private function curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
        curl_close($ch);
    }
    
    public function testConnection(){
        $url =  'https://secure.przelewy24.pl/testConnection';
        return $this->curl($url);
    }
}