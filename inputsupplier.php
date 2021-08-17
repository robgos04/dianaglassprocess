<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","");mysqli_select_db($connect,"gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$namasupplier = $_POST['namasupplier'];
$alamat = $_POST['alamat'];
$contactperson = $_POST['contactperson'];
$notelepon = $_POST['notelepon'];

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL" .
	mysqli_connect_error();
}

if ($namasupplier=="") {
    echo "<script type=\"text/javascript\">window.alert('Silahkan masukkan nama Supplier');window.location.href = 'adminsupplier.php';</script>"; 
}else {
	$query="INSERT INTO supplier (`namasupplier`, `alamat`,`contactperson`, `notelepon`) VALUES ('$namasupplier', '$alamat', '$contactperson', '$notelepon')";
	$result = mysqli_query($connect,$query);
	echo "<script type=\"text/javascript\">window.alert('Input Data Supplier Berhasil.');window.location.href = 'adminsupplier.php';</script>"; 
}
?>