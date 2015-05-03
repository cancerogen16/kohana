<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Template {

    public $template = "basic";

    public function action_index() {
        $auth = Auth::instance();
        $data = array();
        $logged = $auth->logged_in();
        if ($logged) {
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
        $this->template->logged = $logged;
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

        $this->template->logged = Auth::instance()->logged_in();

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

        $this->template->logged = Auth::instance()->logged_in();
        $this->template->content = View::factory('rempassview', $data);
    }
    
    public function action_form() {
        if($this->request->is_initial())
        {
            throw HTTP_Exception::factory(404, 'Файл не найден!');
        }
        
        $this->auto_render = FALSE;
        
        $logged = Auth::instance()->logged_in();
        if($logged)
        {
            $this->response->body(View::factory('authformlogoutview'));
        }
        else 
        {
            $this->response->body(View::factory('authformloginview'));
        }
        $this->template->logged = $logged;
    }
    
    public function action_checkcode() {

        $code = $this->request->param('id');
        $data = array();

        $register = new Model_register();

        if ($register->obnovlenieparolia($code)) {
            $data["ok"] = "";
        } else {
            $data["error"] = "";
        }
        
        $this->template->logged = Auth::instance()->logged_in();
        $this->template->content = View::factory('checkcodeview', $data);
    }

    public function action_hpass() {
        $auth = Auth::instance();
        $hash = $auth->hash_password('admin');
        $this->template->logged = Auth::instance()->logged_in();
        $this->template->content = $hash;
    }

    public function action_logout() {
        $auth = Auth::instance();
        $logged = $auth->logged_in();

        $auth->logout();
        
        $this->template->content = "Разлогинились";
        $this->template->logged = $logged;
    }

}

// End Main
