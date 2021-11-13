<?php 

require "config.php";

$id = $_GET['id'];
$tableName = $_GET['table'];

switch ($tableName){
    case 'pages': $sql = 'DELETE FROM `pages` WHERE `id` = ?'; break;
    case 'news': $sql = 'DELETE FROM `news` WHERE `id` = ?'; break;
}

$query = $pdo->prepare($sql);
$query->execute([$id]);