<?php

class App{
    
    protected $controller = 'home';
    
    protected $method = 'index';
    
    protected $params = [];
    
    public function __construct() {
        
        echo '<pre>', var_dump($this->parseUrl()), '</pre>';
    }
    
    protected function parseUrl() {
        
        if(isset($_GET['url'])) {
            // Trims, filters and splits the (remaining) url then returns it as an array
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
    
}