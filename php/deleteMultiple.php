<?php 

require "config.php";

$id = $_GET['id'];
$tableName = $_GET['table'];
$ids = explode(",", $id);

switch ($tableName){
    case 'pages': $sql = "DELETE FROM `pages` WHERE `id` = ?"; break;
    case 'news': $sql = "DELETE FROM `news` WHERE `id` = ?"; break;
}

$query = $pdo->prepare($sql);

foreach($ids as $id){
    $query->execute([$id]);
}