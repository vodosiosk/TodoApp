<?php
include_once 'config/database.php';
include_once 'objects/todoList.php';
include_once 'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$list = new TodoList($db);
$task = new Task($db);


$list->id=$_POST['id'];
echo $list->delete();
echo $task->deleteByList($list->id);
 
?>