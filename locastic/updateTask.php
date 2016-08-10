<?php
session_start();
include_once 'config/database.php';
include_once 'objects/task.php';
include_once 'ChromePhp.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);

date_default_timezone_set('Europe/Zagreb');

$task->name=$_POST['name'];
$task->priority=$_POST['priority'];
$task->deadline=$_POST['deadline'];
$task->status=isset($_POST['status']) ? 1 : 0;
$task->id=$_POST['id'];

$task->update();
?>

