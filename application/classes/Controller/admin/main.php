<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Main extends Mycontrolleradmin {
	
	public $template = "basic";
	
	public function action_index()
	{
		$view = View::factory('adminview');	
		$this->template->content = $view;
	}
} // End Main
