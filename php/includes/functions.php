<?php

function validation($login,$pass){
    if(empty($login)) return "Вы не ввели логин.";
    else if(empty($pass)) return "Вы не ввели пароль.";
    else if(strlen($pass)<=5) return "Пароль должен быть более 5 символов в длину.";
}