<?php defined('SYSPATH') or die('No direct script access.');

class Mycontroller extends Controller_Template {
	
	public $template = "basic";
	
	public function before()
	{
		$session = Session::instance();
		$session->set('auth_redirect',$_SERVER['REQUEST_URI']);
			
		$auth = Auth::instance();
		if ($auth->logged_in() == 0) {
			HTTP::redirect('auth');	
		}
		return parent::before();
	}
} // End Mycontroller
