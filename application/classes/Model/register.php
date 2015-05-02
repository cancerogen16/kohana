<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Register {

    /**
     * @param $email
     * @param $regcodevalue
     * @param $role
     * @return bool
     */
    public function reg($email, $regcodevalue, $role) {
        $regcode = new Model_Regcode();
        $myuser = new Model_Myuser();

        // Создаем пользователя
        $myuser->username = $email;
        $myuser->email = $email;

        // Генерируем пароль
        $useful = new Model_Useful();
        $genpass = $useful->generatePassword(8);

        $auth = Auth::instance();
        $myuser->password = $auth->hash_password($genpass);

        $regcode->code = $regcodevalue;

        try {
            $regcode->check();
        } catch (ORM_Validation_Exception $e) {
            $this->errors = $e->errors('validation');
            return FALSE;
        }

        try {
            $myuser->save();

            // Узнаем id созданного пользователя
            $usertemp = ORM::factory('myuser', array('username' => $email));
            $adduserid = $usertemp->id;

            //Сохранение роли
            $addrole = new Model_Addrole();
            $addrole->user_id = $adduserid;
            $addrole->role_id = $role;
            $addrole->save();

            //Дезактивация кода
            $regcode->disactive_code($regcodevalue, $adduserid);

            $from = 'don544@mail.ru';
            $subject = 'Регистрация в образовательной системе';
            $message = "Ваш логин:  $email <br />Ваш пароль:  $genpass";
            $useful->sendemail($email, $from, $subject, $message, TRUE);

            return TRUE;
        } catch (ORM_Validation_Exception $e) {
            $this->errors = $e->errors('validation');
            return FALSE;
        }
    }

    public function hochuNoviyParol($email) {
        $usertemp = ORM::factory('myuser', array('username' => $email));
        
        if(!$usertemp->loaded()) {
            return FALSE;
        }
        
        // Генерируем пароль
        $useful = new Model_Useful();
        $genpass = $useful->generatePassword(18);
        
        $usertemp->rempass = $genpass;
        $usertemp->save();
        
        $from = 'don544@mail.ru';
        $subject = 'Восстановление пароля';
        $message = "Перейдите по : <a href='auth/checkcode/$genpass' >ссылке</a>";
        $useful->sendemail($email, $from, $subject, $message, TRUE);
        
        return TRUE;
    }

}
