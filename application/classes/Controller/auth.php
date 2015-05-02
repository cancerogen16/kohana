<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Template {

    public $template = "basic";

    public function action_index() {
        $auth = Auth::instance();
        $data = array();

        if ($auth->logged_in()) {
            HTTP::redirect();
        } else {
            $btnsubmit = filter_input(INPUT_POST, "btnsubmit", FILTER_SANITIZE_SPECIAL_CHARS);
            if ($btnsubmit) {
                $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

                if ($auth->login($login, $password)) {
                    $session = Session::instance();
                    $auth_redirect = $session->get('auth_redirect', '');
                    $session->delete('auth_redirect');

                    HTTP::redirect($auth_redirect);
                } else {
                    $data["error"] = 1;
                }
            }
        }

        $this->template->content = View::factory('authview', $data);
    }

    public function action_reg() {
        $data = array();

        $btnsubmit = filter_input(INPUT_POST, "btnsubmit", FILTER_SANITIZE_SPECIAL_CHARS);
        if ($btnsubmit) {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
            $regcodevalue = filter_input(INPUT_POST, "regcodevalue", FILTER_SANITIZE_SPECIAL_CHARS);

            $register = new Model_register();

            if ($register->reg($email, $regcodevalue, 1)) {
                $data["regok"] = "";
            } else {
                $data["errors"] = $register->errors;
            }
        }

        $this->template->content = View::factory('regview', $data);
    }

    public function action_hochuvspomnit() {
        $data = array();

        $btnsubmit = filter_input(INPUT_POST, "btnsubmit", FILTER_SANITIZE_SPECIAL_CHARS);

        if ($btnsubmit) {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);

            $register = new Model_register();

            if ($register->hochuNoviyParol($email)) {
                $data["ok"] = "";
            } else {
                $data["error"] = "";
            }
        }

        $this->template->content = View::factory('rempassview', $data);
    }
	
	public function action_checkcode() {
        $data = array();

        $btnsubmit = filter_input(INPUT_POST, "btnsubmit", FILTER_SANITIZE_SPECIAL_CHARS);

        if ($btnsubmit) {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);

            $register = new Model_register();

            if ($register->hochuNoviyParol($email)) {
                $data["ok"] = "";
            } else {
                $data["error"] = "";
            }
        }

        $this->template->content = View::factory('checkcodeview', $data);
    }

    public function action_hpass() {
        $auth = Auth::instance();
        $hash = $auth->hash_password('admin');

        $this->template->content = $hash;
    }

    public function action_logout() {
        $auth = Auth::instance();
        $auth->logout();
        $this->template->content = "Разлогинились";
    }

}

// End Main
