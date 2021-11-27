<?php

require_once '../includes/config.php';

$login = $_REQUEST['login'];
$pass = $_REQUEST['pass'];

if(empty($login)) echo "Вы не ввели логин.";
else if(empty($pass)) echo "Вы не ввели пароль.";
else if(strlen($pass)<=5) echo "Пароль должен быть более 5 символов в длину.";

else if( R::count('users', 'login = ? ', array($login)) ) echo "Пользователь с таким логином уже зарегистрирован";

else{
    $user = R::dispense('users');
	$user->login = $login;
    $user->pass = password_hash($pass, PASSWORD_DEFAULT);

    $task = R::dispense('pages');
    $task->title="Моя первая задача";
    $task->content="";

    $user->ownPagesList[] = $task;
    R::store($user);

    echo "OK";
}

