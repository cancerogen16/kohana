<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Template {
	
	public $template = "basic";
	
	public function action_index()
	{
		$auth = Auth::instance();
		$data = array();
		
		if ($auth->logged_in()) {
			HTTP::redirect();		
		} else {
			if (isset($_POST['btnsubmit'])) {
				$login = Arr::get($_POST,'login','');
				$password = Arr::get($_POST,'password','');	
				
				if ($auth->login($login, $password)) {
					$session = Session::instance();
					$auth_redirect = $session->get('auth_redirect','');
					$session->delete('auth_redirect');
		
					HTTP::redirect($auth_redirect);	
				} else {
					$data["error"] = 1;	
				}
			}			
		}
		
		 
		
		
		$this->template->content = View::factory('authview',$data);
	}
	
	public function action_reg()
	{
		$data = array();
		
		if (isset($_POST['btnsubmit'])) {
			$email = Arr::get($_POST,'email','');
			$regcodevalue = Arr::get($_POST,'regcodevalue','');	
			
			$register = new Model_register();
			
			if ($register->reg($email, $regcodevalue, 1)) {
				$data["regok"] = "";	
			} else {
				$data["errors"] = $register->errors;	
			}
		}	
			
		$this->template->content = View::factory('regview',$data);
	}
	
	public function action_hpass()
	{
		$auth = Auth::instance();
		$hash = $auth->hash_password('admin'); 
		
		$this->template->content = $hash;
	}
	
	public function action_logout()
	{
		$auth = Auth::instance();
		$auth->logout();	
		$this->template->content = "Разлогинились";
	}
} // End Main
