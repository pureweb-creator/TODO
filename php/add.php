<?php
require_once("includes/config.php");

$task = $_REQUEST['task'];
$list = $_REQUEST['table'];
$uid  = $_SESSION['logged_user']->id;

$cur_user = R::load('users', $uid);

$taskToAdd = R::dispense($list);
$taskToAdd->title = $task;
$taskToAdd->content='';

$cur_user->ownPagesList[] = $taskToAdd;
R::store($cur_user);