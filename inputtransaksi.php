<?php
session_start();
//include("php/config.php");
//$connect=mysqli_connect("localhost","root","");
//mysqli_select_db($connect,"gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$iddetailbarang = $_POST['iddetail'];
//$kodebarang = $_POST['kodebarang'];
$stok = $_POST['stok'];
//$namabarang = $_POST['namabarang'];
$qty = $_POST['qty'];
$usertransaksi = $_POST['usertransaksi'];
$customer = $_POST['ketcustomer'];
$sisastok = $stok - $qty;

$ket = $_POST['ket2'];
if($ket=="") {
	$keterangan = $ket."".$customer;
}else {
	$keterangan = $ket.", ".$customer;
}

$date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
$tanggal= $date->format('Y-m-d H:i:s');

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL" .
	mysqli_connect_error();
}

if($customer=="" || $customer=="- List Customer -") {
    echo "<script type=\"text/javascript\">window.alert('No Input Transaction! Please Select the customer');window.location.href = 'admintransaksi.php';</script>"; 
} else if($stok==0) {
     echo "<script type=\"text/javascript\">window.alert('No Input Transaction! No Stock in Inventory');window.location.href = 'admintransaksi.php';</script>"; 
} else if($qty > $stok) {
     echo "<script type=\"text/javascript\">window.alert('No Input Transaction! The amount Qty exceeds the Stock');window.location.href = 'admintransaksi.php';</script>"; 
} else {
	$query="INSERT INTO transaksi (`iddetailbarang`, `qty`, `sisastok`, `keterangan`, `customer`, `usertransaksi`, `tanggaltransaksi`) VALUES ('$iddetailbarang', '$qty', '$sisastok', '2', '$keterangan', '$usertransaksi', '$tanggal')";
	$result = mysqli_query($connect,$query);
	
	$query1="UPDATE detailbarang SET stok='$sisastok' where iddetailbarang=$iddetailbarang";
	$result1 = mysqli_query($connect,$query1);
	echo "<script type=\"text/javascript\">window.alert('Input Data Transaksi Berhasil.Stok out:\'$qty\'pcs');window.location.href = 'admintransaksi.php';</script>"; 
}
?>