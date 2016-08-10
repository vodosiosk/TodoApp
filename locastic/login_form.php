<?php
session_start();

if(isset($_SESSION["userSession"])){    
    header("location: dashboard.php");
}
?>
<form id='login-form' action='#' method='post' border='0'>
	<table class='table table-hover table-responsive table-bordered'>
		<tr>
            <td>Email</td>
            <td><input type='email' name='email' class='form-control' required /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type='password' name='password' class='form-control' required /></td>
        </tr>
        <tr>
        	<td></td>
        	<td>
        		<button type='submit' class='btn btn-primary'>Log in</button>
        		<button id='registration-form-btn' type='button' class='btn btn-primary'>Registration</button>
        	</td>        	
        </tr>
    </table>
</form>