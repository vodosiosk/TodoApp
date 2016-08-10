<?php
session_start();
include_once 'config/database.php';
include_once 'objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->email=$_POST['email'];
$user->password=$_POST['password'];

$stmt = $user->getUser();
$count = $stmt->rowCount();

if($count>0) {
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$userId = $row['id'];
	$_SESSION['userSession'] = $userId;
	$user->id = $userId;
	$user->updateLastLogin();
	echo $stmt;
} else {
	echo $count;
}
?>

