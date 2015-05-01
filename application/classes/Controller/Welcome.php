<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
		$this->response->body('hello, world!');
	}

	public function action_test()
	{
	    // Это Контроллер
		$config = Kohana::$config->load('mysite'); 
		 
		// А это уже Вид
		foreach ($config as $site_config)
		{
		    if(is_array($site_config))
		        echo $site_config['main'] . '<br>' . $site_config['alt'];
		    else
		        echo $site_config . '<br>';	
		}
	}

} // End Welcome
