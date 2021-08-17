<?php
session_start();
$namafolder="images/";

include("config.php");

$email = $_GET["emailsignup"];
$user = $_GET["usernamesignup"];
$pass = $_GET["passwordsignup"];

//$pass2 = md5($pass2);

	$query="INSERT INTO user (`email`,`username`,`password`) VALUES ('$email','$user','$pass')";
	$result = mysql_query($query); 
?>