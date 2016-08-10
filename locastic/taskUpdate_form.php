<?php

$taskId = $_GET['taskId'];
$listId = $_GET['listId'];

include_once 'config/database.php';
include_once 'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);

$task->id = $taskId;

$task->readOne();
?>

<form id='task-update-form' action='#' method='post' border='0'>
	<table class='table table-hover table-responsive table-bordered'>
		<tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' value='<?php echo htmlspecialchars($task->name, ENT_QUOTES); ?>' required /></td>
        </tr>
        <tr>
            <td>Priority</td>
            <td>
                <select name='priority' class='form-control'>
                    <option value="low" <?php if(htmlspecialchars($task->priority, ENT_QUOTES) == 'low') {echo "selected";} ?>>Low</option>
                    <option value="normal" <?php if(htmlspecialchars($task->priority, ENT_QUOTES) == 'normal') {echo "selected";} ?>>Normal</option>
                    <option value="high" <?php if(htmlspecialchars($task->priority, ENT_QUOTES) == 'high') {echo "selected";} ?>>High</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Deadline</td>
            <td><input type='date' name='deadline' class='form-control' value='<?php echo htmlspecialchars($task->deadline, ENT_QUOTES); ?>' required /></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><input type='checkbox' name='status' class='form-control' <?php if(htmlspecialchars($task->status, ENT_QUOTES) == 1) {echo "checked"; } ?>/></td>
        </tr>      
        <tr>
        	<td></td>
        	<td>
        		<button type='submit' class='btn btn-primary'>Create</button>
                <div id='list-id' class='display-none'><?php echo $listId ?></div>
                <input type='hidden' name='id' value='<?php echo $taskId; ?>'/>
        	</td>        	
        </tr>
    </table>
</form>