<?php
session_Start();
//include("php/config.php");
//include 'connectdb.php';
$connect=mysqli_connect("localhost","root","","gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

/*
mysqli_query($connect,"delete from user where iduser=$_GET[id]");
if(mysqli_affected_rows()>0)
{
echo "<script>alert('Information updated')</script>";
}
$check=mysqli_affected_rows();

header("location:adminuser.php"); */

$sql="delete from user where iduser=$_GET[id]";
if(mysqli_query($connect,$sql)) {
	echo "<script type=\"text/javascript\">window.alert('Delete Data User Berhasil.');window.location.href = 'adminuser.php';</script>"; 
}
else {}

mysql_close($connect);

?>