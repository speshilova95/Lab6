<?php
require  'database.php';
require  'clients.php';
session_start();
if ($_SESSION['test'] = $_SERVER['REMOTE_ADDR'])
{
session_start();
$email = $_POST["email"];
$password = $_POST["password"];
$surname = $_POST["surname"];
$name = $_POST["name"];
$tel = $_POST["phone"];
$connect = new Database('SeaTour', 'root', '', 'localhost');
try 
{
	$clients = new Client($email, $password, $surname, $name, $tel);
	$clients->save();
	$_SESSION['message'] = 'Your registration was successful!';
}
catch (Exception $e)
{
	$_SESSION['message'] = $e->getMessage();
}
}
else
{
	$_SESSION['message'] = 'Access is closed.';
}
back();

function back()
{
	$back = $_SERVER['HTTP_REFERER']; 
	echo "
	<html>
	  <head>
	   <meta http-equiv='Refresh' content='0; URL=".$_SERVER['HTTP_REFERER']."'>
	  </head>
	</html>";
}
?>
