<?php
//Default controller
class Home extends Controller {
    
    // Default method
    public function index($name = '', $other_name = '') {
        echo $name, ' ', $other_name;
    }
}