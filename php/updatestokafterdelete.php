<?php
session_start();
include("config.php");

$qty = $_GET["qty1"];
$iddetailbarang = $_GET["iddetail1"];
$idtransaksi1 = $_GET["idtransaksi"];
$user = $_GET["user"];
$keterangan = $_GET["keterangan"];

$date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
$tanggal= $date->format('Y-m-d H:i:s');

$result1 = mysqli_query ($con,"SELECT * FROM `detailbarang` WHERE iddetailbarang='$iddetailbarang'");
$value = mysqli_fetch_object($result1);
$stokdata = $value->stok;
echo "<script type=\"text/javascript\">window.alert('".$stokdata."');</script>";

if($keterangan==2 || $keterangan==4) {
	$stokawal = $stokdata + $qty;
	
	//UPDATE DATA-DATA SELANJUTNYA
	$sql2 = "UPDATE transaksi SET sisastok=sisastok+'$qty' WHERE iddetailbarang='$iddetailbarang' AND idtransaksi > '$idtransaksi1'";
	$result2 = mysqli_query($con,$sql2);
	
} else if ($keterangan==1 || $keterangan==3) {
	$stokawal = $stokdata - $qty;
	
	//UPDATE DATA-DATA SELANJUTNYA
	$sql3 = "UPDATE transaksi SET sisastok=sisastok-'$qty' WHERE iddetailbarang='$iddetailbarang' AND idtransaksi > '$idtransaksi1'";
	$result3 = mysqli_query($con,$sql3);
}

	$query="UPDATE `detailbarang` SET `stok`='$stokawal',`userstok`='$user',`tanggalupdate`='$tanggal' WHERE `iddetailbarang`='$iddetailbarang'";
	$result = mysqli_query($con, $query);
	//echo "<script type=\"text/javascript\">window.alert('Registrasi Berhasil.');window.location.href = 'profile.html';</script>"; 
?>