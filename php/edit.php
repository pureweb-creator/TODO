<?php
require 'config.php';

$table = $_GET['table'];
$id = $_GET['id'];
$task = $_GET['task'];

switch ($table){
    case 'pages':$sql = "UPDATE pages SET `title` =:title,`content`=:content WHERE `id`=:id"; break;
    case 'news':$sql = "UPDATE news SET `title` =:title,`content`=:content WHERE `id`=:id"; break;
}

$pdo->prepare($sql)->execute(['title'=>$task, 'content'=>'','id'=>$id]);