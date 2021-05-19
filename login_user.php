<?php 
use sarassoroberto\usm\entity\User;
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

if($_SERVER['REQUEST_METHOD']==='POST'){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $val = new LoginValidation($email, $password);
    $emailValidation = $val -> getError('email');
    $passwordValidation = $val -> getError('password');


    
    list($email,$emailClass,$emailClassMessage,$emailMessage) = ValidationFormHelper::getValidationClass($email);
    list($password,$passwordClass,$passwordClassMessage,$passwordMessage) = ValidationFormHelper::getValidationClass($password);
  


    

}











include'./src/view/login_user_view.php';