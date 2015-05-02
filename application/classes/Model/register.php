<?php defined('SYSPATH') or die('No direct script access.');

class Model_Register
{

	public function reg($email, $regcodevalue)	
	{
		$regcode = new Model_Regcode();
		$user = new Model_User();
		
		// Создаем пользователя
		$user->username = $email;
		$user->email = $email;
		$user->password = "123456";
		$user->save();
		
		// Узнаем id созданного пользователя
		$usertemp = ORM::factory('user', array('username'=>$email));
		$adduserid = $usertemp->id;
		
		return TRUE;
	}
}
