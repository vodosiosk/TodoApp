<?php
session_start();
unset($_SESSION['userSession']);
header('Location: login_form.php');
?>

