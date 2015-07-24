<?php
// Load models and render views - template for other controllers
class Controller {
    protected function model($model) {
        if(file_exists('../app/models/'.$model.'.php')) {
            require_once '../app/models/'.$model.'.php';
            return new $model;
        }
    }
    
    // Gets our view
    protected function view($view, $data = []) {
        require_once '../app/views/'.$view.'.php';
    }
}