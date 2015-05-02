<?php defined('SYSPATH') or die('No direct script access.');

class Model_Myuser extends ORM 
{
	protected $_table_name = 'users';
	
	public function rules()
	{
		return array(
			'username' => array(
				array('not_empty'),
				array('email'),
				array('max_length', array(':value', 32)),
				array(array($this, 'username_unique')),
			),
		);
	}
	
	public function username_unique($username)
	{
		$usertemp = ORM::factory('myuser', array('username' => $username));
		
		if ($usertemp->loaded()) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
}
