<?php
require_once('config.php');

$tableName = $_GET['table'];
$response = [];

switch ($tableName){
    case 'pages': $query = $pdo->query('SELECT * FROM `pages`'); break;
    case 'news': $query = $pdo->query('SELECT * FROM `news`'); break;
}

while($row = $query->fetch(PDO::FETCH_OBJ)){
    $response[] = $row;
}

echo json_encode($response);