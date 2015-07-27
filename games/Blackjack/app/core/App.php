<?php
// Our controller controller!
class App {
    
    // Default controller
    protected $controller = 'home';
    
    // Default method
    protected $method = 'index';
    
    // Any other parameters (anything after home/index)
    protected $params = [];
    
    public function __construct() {
        // Store the parsed
        $url = $this->parseUrl();
        
        // Check there's a controller with the name in url
        if(file_exists('../app/controllers/'.$url[0].'.php')) {
            // Replace default
            $this->controller = $url[0];
            // Remove from the array
            unset($url[0]);
        }
        
        // Require in the specified (or default controller)
        require_once '../app/controllers/'.$this->controller.'.php';
        
        // Create a new instance of it
        $this->controller = new $this->controller;
        
        // Check if there's a method specified in the url - to specifiy a method,
        // you must specify a url
        if(isset($url[1])) {
            // Check that method actually exists in the controller
            if(method_exists($this->controller, $url[1])) {
                // Replace default
                $this->method = $url[1];
                // Allows you to have no specified method/controller and still
                // have parameters on the default
                unset($url[1]);
            }
        }
        
        // Will empty the entire array into params (if there's no controller or 
        // method specified it uses defaults
        $this->params = $url ? array_values($url) : [];
        
        // Callback on controller->method(params)
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    // Takes the url and splits it into an array of separate vars
    protected function parseUrl() {
        
        if(isset($_GET['url'])) {
            // Trims trailing characters after final /
            // then filters and splits the (remaining) url by /
            // First arg will be controller, second method, then args
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
    
}