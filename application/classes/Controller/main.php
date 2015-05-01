<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Template {
	
	public $template = "basic";
	
	public function action_index()
	{
		
		$data["message1"] = "1234dffffffffff56";	
		
		$auth = Auth::instance();
		
		if ($auth->logged_in()) {
			$data["message"] = "Залогинен<br />";	
		} else {
			$data["message"] = "Не залогинен<br />";		
		}
		
		if (isset($_POST['btnsubmit'])) {
			$login = Arr::get($_POST,'login','');
			$password = Arr::get($_POST,'password','');	
			
			if ($auth->login($login, $password)) {
				$data["error"] = 0;	
			} else {
				$data["error"] = 1;	
			}
			
			
		} 
		
		
		$this->template->content = View::factory('home',$data);
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
