<?php

/**
 * Default home controller, used when no controller or method has been passed to
 * app.
 */
class Home extends Controller {
    
    /**
     * Default controller method - used when no method passed to app.
     * 
     * @param type $name
     * @param type $mood
     */
    public function index($name = 'alex', $mood = 'happy') {
        $user = $this->model('User');
        $user->name = $name;
        
        $this->view('home/index', [
            'name' => $user->name,
            'mood' => $mood
        ]);
    }
}