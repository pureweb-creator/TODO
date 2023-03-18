<?php
require_once("../includes/config.php");

$login = $_REQUEST['login'];
$pass = $_REQUEST['pass'];

if(empty($login)) echo "Вы не ввели логин.";
else if(empty($pass)) echo "Вы не ввели пароль.";
else if(strlen($pass)<=5) echo "Пароль должен быть более 5 символов в длину.";

$user = R::findOne('users', 'login = ?', array($login));

if( $user && password_verify($pass, $user->pass) ){
    $_SESSION['auth_subsystem'] = $user;
    $user['is_logged'] = true;

    echo "OK";
} else echo "Логин или пароль неверный";