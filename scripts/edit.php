<?php
require 'includes/config.php';

$table = $_GET['table'];
$id    = $_GET['id'];
$task  = $_GET['task'];

$taskToUpdate = R::load($table,$id);
$taskToUpdate->title=$task;
$taskToUpdate->content='';

R::store($taskToUpdate);