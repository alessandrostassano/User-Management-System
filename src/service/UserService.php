<?php

namespace sarassoroberto\usm\services;

use sarassoroberto\usm\model\UserModel;

class  UserSession {

    public function autenticate(string $email, string $password) 
    {
        $um = new UserModel();
        $user = $um->autenticate($email, $password);

        if (!is_null($user)) {
            $_SESSION['user-autenticate'] = $user;
        } else {
            unset($_SESSION['user_autenticated']);
        }
    }
}