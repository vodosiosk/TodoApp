<?php
include_once 'config/database.php';
include_once 'objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->email=$_POST['email'];
$user->password=$_POST['password'];
$user->name=$_POST['name'];
$user->lastName=$_POST['lastName'];

date_default_timezone_set('Europe/Zagreb');
$user->regDate=date('Y-m-d H:i:s');

$checkStmt = $user->checkEmail();
$count = $checkStmt->rowCount();

if($count>0) {	
	echo 'Email already in use';
} else {	
	echo $count;
	//confirmation mail code
	$user->register();
}
?>

