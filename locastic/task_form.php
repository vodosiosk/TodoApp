<?php
$listId = $_GET['id'];
?>

<form id='task-form' action='#' method='post' border='0'>
	<table class='table table-hover table-responsive table-bordered'>
		<tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' required /></td>
        </tr>
        <tr>
            <td>Priority</td>
            <td>
                <select name='priority' class='form-control'>
                    <option value="low">Low</option>
                    <option value="normal">Normal</option>
                    <option value="high">High</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Deadline</td>
            <td><input type='date' name='deadline' class='form-control' required /></td>
        </tr>      
        <tr>
        	<td></td>
        	<td>
        		<button type='submit' class='btn btn-primary'>Create</button>
                <div id='list-id' class='form-control display-none'><?php echo $listId ?></div>
        	</td>        	
        </tr>
    </table>
</form>