<?php
session_start();
//header("location: index.php");

include_once 'config/database.php';
include_once 'objects/todoList.php';
include_once 'objects/task.php';
include_once 'ChromePhp.php';

$database = new Database();
$db = $database->getConnection();

$todoList = new TodoList($db);

if(isset($_GET['param'])){
    $stmt = $todoList->readSortedByParam($_SESSION['userSession'], $_GET['param']);
}else{
    $stmt = $todoList->readByUserId($_SESSION['userSession']);
}

$count = $stmt->rowCount();

if($count>0){

	echo "<table class='table table-bordered table-hover'>";

	echo "<tr>";
        echo "<th class='width-30-pct' id='todo-name-col'>Name</th>";
        echo "<th class='width-30-pct' id='todo-created-col'>Created</th>";
        echo "<th class='width-30-pct'>Tasks</th>";        
        echo "<th class='width-30-pct'>Unfinished</th>";      
        echo "<th style='text-align:center;'>Action</th>";        
        echo "<th><div id='new-btn' class='btn btn-primary'>New</div></th>";
    echo "</tr>";

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	extract($row);

        $task = new Task($db);
        $todoList->cnt = $task->readByList($id)->rowCount();
        $todoList->todoCnt = $task->readByStatus($id, 0)->rowCount();

    	echo "<tr>";
                echo "<td>{$name}</td>";
                echo "<td>{$created}</td>";
                echo "<td>{$todoList->cnt}</td>";
                echo "<td>{$todoList->todoCnt}</td>";
                echo "<td style='text-align:center;'>";
                    echo "<div class='list-id display-none'>{$id}</div>";
                    echo "<div class='btn btn-info edit-btn margin-right-1em'>Edit</div>";
                    echo "<div class='btn btn-danger delete-btn'>Delete</div>";                        
                echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}else{
		echo "<div class='alert alert-info'>No records found.</div>";
        echo "<div id='new-btn' class='btn btn-primary'>New</div>";
}
?>

