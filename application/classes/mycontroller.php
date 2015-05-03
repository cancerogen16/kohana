<?php

defined('SYSPATH') or die('No direct script access.');

class Mycontroller extends Controller_Template {

    public $template = "basic";
    public $logged ;

    public function before() {
        $session = Session::instance();
        $session->set('auth_redirect', $_SERVER['REQUEST_URI']);

        $auth = Auth::instance();
        $logged = $auth->logged_in(); 
        $this->logged = $logged;
        if ($logged == 0) {
            //HTTP::redirect('auth');
        }
        return parent::before();
    }

}

// End Mycontroller
