<?php
require_once('includes/config.php');

$tableName = $_GET['table'];
$response = [];
$uid = @$_SESSION['auth_subsystem']->id;

$taskslist = R::find($tableName,'users_id = :id',[':id'=>$uid]);

foreach($taskslist as $task){
    $response[] = $task;
}

echo json_encode($response);