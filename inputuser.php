<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","");mysqli_select_db($connect,"gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$statususer = $_POST['role1'];

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL" .
	mysqli_connect_error();
}


	$query="INSERT INTO user (`email`, `username`, `password`, `statususer`) VALUES ('$email', '$username', '$password', '$statususer')";
	$result = mysqli_query($connect,$query);
	echo "<script type=\"text/javascript\">window.alert('Input Data User Berhasil.');window.location.href = 'adminuser.php';</script>"; 
?>