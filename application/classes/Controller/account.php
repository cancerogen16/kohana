<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Account extends Mycontrollerlogin {

    public $template = "basic";

    public function action_index() {
        $myuser = new Model_Myuser();
        $data['username'] = $myuser->displayusername();
        
        $btnsubmit = filter_input(INPUT_POST, "btnsubmit", FILTER_SANITIZE_SPECIAL_CHARS);

        if ($btnsubmit) {
            $oldpass = filter_input(INPUT_POST, "oldpass", FILTER_SANITIZE_SPECIAL_CHARS);
            $newpass1 = filter_input(INPUT_POST, "newpass1", FILTER_SANITIZE_SPECIAL_CHARS);
            $newpass2 = filter_input(INPUT_POST, "newpass2", FILTER_SANITIZE_SPECIAL_CHARS);
        
            if($myuser->saveNewPass($oldpass,$newpass1,$newpass2))
            {
                $data['newpassok'] = "";
            } else {
                $data['errors'] = $myuser->getErrors();
            }
            
        }
        
        $this->template->logged = Auth::instance()->logged_in();
        $this->template->content = View::factory('accountview', $data);
    }

}

// End Main
