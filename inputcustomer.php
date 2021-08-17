<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","");
mysqli_select_db($connect,"gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$namacustomer = $_POST['namacustomer'];
$alamatcustomer = $_POST['alamatcustomer'];
$contactpersoncustomer = $_POST['contactpersoncustomer'];
$notelpcustomer = $_POST['notelpcustomer'];
$usertransaksi = $_POST['usertransaksi'];

$date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
$tanggal= $date->format('Y-m-d H:i:s');

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL" .
	mysqli_connect_error();
}

if($namacustomer=="" || $alamatcustomer=="" || $notelpcustomer=="") {
    echo "<script type=\"text/javascript\">window.alert('Silahkan masukkan data yang required');window.location.href = 'admincustomer.php';</script>";
}else {

	$query="INSERT INTO customer (`namacustomer`, `alamatcustomer`,`contactpersoncustomer`, `notelpcustomer`, `userupdate`, `tanggalupdatecustomer`) VALUES ('$namacustomer', '$alamatcustomer', '$contactpersoncustomer', '$notelpcustomer', '$usertransaksi', '$tanggal')";
	$result = mysqli_query($connect,$query);
	echo "<script type=\"text/javascript\">window.alert('Input Data Customer Berhasil.');window.location.href = 'admincustomer.php';</script>";
}
?>