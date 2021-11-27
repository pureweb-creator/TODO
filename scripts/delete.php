<?php 

require "includes/config.php";

$id = $_GET['id'];
$ids = explode(",", $id);
$tableName = $_GET['table'];

if( !is_array($ids) ){
    $taskToDelete = R::load($tableName,$id);
    R::trash($taskToDelete);
} else {
    $tasksToDelete = [];
    foreach($ids as $id)
        $tasksToDelete[] = R::load($tableName,$id);
    R::trashAll($tasksToDelete);
}