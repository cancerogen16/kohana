<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller {

    public function action_emailunique() {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $myuser = new Model_Myuser();
        $res = $myuser->username_unique($email);
        echo json_encode(array('result' => $res));
    }

}

// End Main
