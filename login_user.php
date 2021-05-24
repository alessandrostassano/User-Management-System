<?php 

use sarassoroberto\usm\model\UserModel;
use sarassoroberto\usm\validator\bootstrap\ValidationFormHelper;
use sarassoroberto\usm\validator\LoginValidation;
use sarassoroberto\usm\validator\UserValidation;

require "./__autoload.php";

$title = 'LOGIN';
$action = './login_user_view.php';
$submit = 'accedi';


if($_SERVER['REQUEST_METHOD']==='GET'){

    list($email,$emailClass,$emailClassMessage,$emailMessage) = ValidationFormHelper::getDefault();
    list($password,$passwordClass,$passwordClassMessage,$passwordMessage) = ValidationFormHelper::getDefault();
}

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
  
        $user = (new UserModel())->autenticate($email,$password);
        print_r($user);
        if(is_null($user)){ $msg = "credenziali errate"; }else{
            header("location: list_users.php");
        }

}

include'./src/view/login_user_view.php';