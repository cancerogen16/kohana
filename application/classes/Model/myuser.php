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
		$db = Database::instance();
		
		if ($this->id) {
			$query = 
				'SELECT id
				FROM users
				WHERE id != '.$this->id.' AND username = '.$db->escape($username);
			
		} else {
			$query = 
				'SELECT id
				FROM users
				WHERE username = '.$db->escape($username);
		}
		
		$result = $db->query(Database::SELECT,$query,FALSE)->as_array();
        
		if (count($result) > 0) {
			return FALSE;	
		} else {
			return TRUE;	
		}
	}
	
}
