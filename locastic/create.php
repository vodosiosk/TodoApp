<?php
session_start();
include_once 'config/database.php';
include_once 'objects/todoList.php';

$database = new Database();
$db = $database->getConnection();

$todoList = new TodoList($db);

$todoList->name=$_POST['name'];
$todoList->userId=$_SESSION['userSession'];
date_default_timezone_set('Europe/Zagreb');
$todoList->created=date('Y-m-d H:i:s');

$todoList->create();
?>

