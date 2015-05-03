<?php

defined('SYSPATH') or die('No direct script access.');

class Mycontrollerlogin extends Controller_Template {

    public $template = "basic";
    public $logged ;
    
    public function before() {
        $session = Session::instance();
        $session->set('auth_redirect', $_SERVER['REQUEST_URI']);

        $auth = Auth::instance();
        
        if ($auth->logged_in() == 0) {
            HTTP::redirect('auth');
        }
        $this->logged = TRUE;
        return parent::before();
    }

}

// End Mycontroller
