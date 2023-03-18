<?php

require_once '../includes/config.php';

$login = $_REQUEST['login'];
$pass = $_REQUEST['pass'];

$response = [];

if(empty($login)){
    $response["error"]["no_login"] = true;
    print_r(json_encode($response));
}
else if(empty($pass)){
    $response["error"]["no_pass"] = true;
    print_r(json_encode($response));   
}
else if(strlen($pass)<=5){
    $response["error"]["wrong_pass"] = true;
    print_r(json_encode($response));
}

else if( R::count('users', 'login = ? ', array($login)) ){
    $response["error"]["same_login"] = true;
    print_r(json_encode($response));
}

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

