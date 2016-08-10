<?php
include_once 'config/database.php';
include_once 'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);
$task->id = $_POST['id'];

echo $task->delete();
?>