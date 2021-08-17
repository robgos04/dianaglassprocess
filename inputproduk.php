<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root",""); mysqli_select_db($connect,"gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$kodeproduk = $_POST['kodeproduk'];
$namaproduk = $_POST['namaproduk'];
$deskripsi = $_POST['deskripsi'];
//$harga = $_POST['harga'];

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL" .
	mysqli_connect_error();
}

	$query="INSERT INTO produk (`kodeproduk`, `namaproduk`, `deskripsi`) VALUES ('$kodeproduk', '$namaproduk', '$deskripsi')";
	$result = mysqli_query($connect,$query);
	echo "<script type=\"text/javascript\">window.alert('Input Data Barang Berhasil.');window.location.href = 'adminproduk.php';</script>"; 
?>