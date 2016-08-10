<?php
session_start();
include_once 'config/database.php';
include_once 'objects/todoList.php';
include_once 'objects/task.php';
include_once 'ChromePhp.php';

date_default_timezone_set('Europe/Zagreb');

$database = new Database();
$db = $database->getConnection();

$todoList = new TodoList($db);

if(isset($_GET['id'])){
    $todoList->id = $_GET['id'];
    $stmt = $todoList->readById($_SESSION['userSession']);
}else{
    $stmt = $todoList->readLatest($_SESSION['userSession']);
}

$count = $stmt->rowCount();

if($count>0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);

    $_SESSION['currentList'] = $id;
    
    $task = new Task($db);

    if(isset($_GET['param'])){
        $taskStmt = $task->readSortedByParam($id, $_GET['param']);
    }else{
        $taskStmt = $task->readByList($id);
    }    

    $todoList->cnt = $taskStmt->rowCount();
    $todoList->todoCnt = $task->readByStatus($id, 0)->rowCount();
    $todoList->calculateProgress();

    echo "<table class='table table-bordered table-hover'>";

        echo "<tr><h3>List info</h3></tr>";
    	echo "<tr>";
            echo "<th class='width-30-pct'>Name</th>";
            echo "<th class='width-30-pct'>Created</th>";
            echo "<th class='width-30-pct'>Tasks</th>";        
            echo "<th class='width-30-pct'>Unfinished</th>";      
            echo "<th class='width-30-pct'>Completed</th>";            
            echo "<td style='text-align:center;'>";
                echo "<div class='btn btn-primary dashboard-btn'>Dashboard</div>";
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td class='width-30-pct'>{$name}</td>";
            echo "<td class='width-30-pct'>{$created}</td>";
            echo "<td class='width-30-pct'>{$todoList->cnt}</td>";        
            echo "<td class='width-30-pct'>{$todoList->todoCnt}</td>";      
            echo "<td class='width-30-pct'>{$todoList->progress}%</td>";
            echo "<td style='text-align:center;'>";
                echo "<div id='list-id' class='display-none list-id'>{$id}</div>";
                echo "<div class='btn btn-primary delete-btn'>Delete</div>";
            echo "</td>";

        echo "</tr>";

    echo "</table>";
    
    echo "<table class='table table-bordered table-hover'>";
    
        echo "<tr><h4>Tasks</h4></tr>";
        echo "<tr>";
            echo "<th class='width-30-pct' id='task-name-col'>Name</th>";
            echo "<th class='width-30-pct' id='task-priority-col'>Priority</th>";
            echo "<th class='width-30-pct' id='task-deadline-col'>Deadline</th>";        
            echo "<th class='width-30-pct' id='task-status-col'>Status</th>";      
            echo "<th class='width-30-pct'>Days remaining</th>";
            echo "<th style='text-align:center;'>Action</th>";        
            echo "<th><div id='task-new-btn' class='btn btn-primary'>New</div></th>";
        echo "</tr>";

        if($todoList->cnt > 0) {
            while($taskRow = $taskStmt->fetch(PDO::FETCH_ASSOC)){
            $taskId = $taskRow['id'];
            extract($taskRow);

            $task->deadline = $deadline;
            $daysRemaining = $task->daysRemaining();

            echo "<tr>";
                echo "<td>{$name}</td>";
                echo "<td>{$priority}</td>";
                echo "<td>{$deadline}</td>";
                echo "<td>{$status}</td>";
                echo "<td>{$daysRemaining}</td>";
                echo "<td style='text-align:center;'>";
                    echo "<div class='task-id display-none'>{$taskId}</div>";
                    echo "<div class='btn btn-info task-edit-btn margin-right-1em'>Edit</div>";
                    echo "<div class='btn btn-danger task-delete-btn'>Delete</div>";                        
                echo "</td>";
            echo "</tr>";
            }        
        }else{
            echo "<tr class='alert alert-info'>";
                echo "<td class='alert alert-info' align='center' colspan='7'>No tasks found.</td>";
            echo "</tr>";
        }
        echo "</table>";
        
}else{
		echo "<div class='alert alert-info'>No records found.</div>";
}
?>

