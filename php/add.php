<?php
require 'config.php';


$task = $_REQUEST['task'];
$list = $_REQUEST['table'];

switch ($list){
    case 'pages': $query = $pdo->prepare("INSERT INTO pages SET `title`= :title, `id`= :id, `content`= :content"); break;
    case 'news': $query = $pdo->prepare("INSERT INTO news SET `title`= :title, `id`= :id, `content`= :content"); break;
}
$query->execute(['title'=> $task, 'id'=>NULL, 'content'=>'']);