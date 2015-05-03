<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Mycontroller {

    public $template = "basic";

    public function action_index() {
        $this->template->logged = $this->logged;
        $this->template->content = View::factory('home');
    }

}

// End Main
