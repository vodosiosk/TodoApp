<?php
session_start();
include_once 'config/database.php';
include_once 'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);

date_default_timezone_set('Europe/Zagreb');

$task->name=$_POST['name'];
$task->priority=$_POST['priority'];
$task->deadline=$_POST['deadline'];
$task->status=0;
$task->listId=$_SESSION['currentList'];

$task->create();
?>

