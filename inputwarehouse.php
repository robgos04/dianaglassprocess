<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","");mysqli_select_db($connect,"gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$namawarehouse = $_POST['namawarehouse'];
$lokasiwarehouse = $_POST['lokasiwarehouse'];

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL" .
	mysqli_connect_error();
}

if($namawarehouse=="") {
    echo "<script type=\"text/javascript\">window.alert('Silahkan masukkan nama Warehouse');window.location.href = 'adminwarehouse.php';</script>"; 
}else {

	$query="INSERT INTO warehouse (`namawarehouse`, `lokasiwarehouse`) VALUES ('$namawarehouse', '$lokasiwarehouse')";
	$result = mysqli_query($connect,$query);
	echo "<script type=\"text/javascript\">window.alert('Input Data Warehouse Berhasil.');window.location.href = 'adminwarehouse.php';</script>"; 
}
?>