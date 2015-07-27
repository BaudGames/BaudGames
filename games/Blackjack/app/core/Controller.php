<?php
// Load models and render views - template for other controllers
class Controller {
    
    protected function model($model) {
        if(file_exists('../app/controllers/'.$model.'.php')) {
            require_once '../app/models/'.$model.'.php';
            return new $model();
        }
    }
    
    protected function view($view, $data = []) {
        require_once '../app/views/'.$view.'.phtml';
    }
}