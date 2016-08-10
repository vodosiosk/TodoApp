<?php
session_start();
include_once 'config/database.php';
include_once 'objects/todoList.php';
include_once 'objects/task.php';
include_once 'ChromePhp.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);

date_default_timezone_set('Europe/Zagreb');

$task->name=$_POST['name'];
$task->priority=$_POST['priority'];
$task->deadline=$_POST['deadline'];
$task->status=0;
$task->listId=$SESSION['currentList'];

$task->create();
?>

