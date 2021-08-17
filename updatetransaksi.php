<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","","gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//mysqli_select_db("flight1",$connect);
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$idtransaksi = $_POST['idtransaksi'];
$iddetailbarang = $_POST['iddetail'];
$stokasli = $_POST['stokasli'];
$ketcustomer = $_POST['ketcustomer'];
$qty = $_POST['qty'];
$qtytemp = $_POST['qtytemp'];
$stokawal = $_POST['stokawal'];
$sisastok = $stokawal - $qty;

$userupdate = $_POST['usertransaksi'];

$date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
$tanggal = $date->format('Y-m-d H:i:s');

/*
if($hsl<0) {
	$qty = $update - $stoksebelumnya;
	$ket = 1; //In
} elseif ($hsl==0) {
	$qty = $hsl;
	$ket = 0;
} elseif ($hsl>0) {
	$qty = $hsl;
	$ket = 2; //Out
} */

//$date = date('Y-m-d H:i:s');

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL" .
	mysqli_connect_error();
}

/*echo "<script type=\"text/javascript\">window.alert('".$stoksebelumnya."');</script>"; */

//UPDATE DATA YG INI SAJA
$sql1 = "UPDATE transaksi SET iddetailbarang='$iddetailbarang',qty='$qty',sisastok='$sisastok',keterangan='2', customer='$ketcustomer',usertransaksi='$userupdate',tanggaltransaksi='$tanggal' where idtransaksi=$idtransaksi";
$result1 = mysqli_query($connect,$sql1);

//REAL TIME STOCK
if($qty>=$qtytemp) {
	$temp = $qty - $qtytemp;
	$hsl = $stokasli-$temp;
	
	//UPDATE DATA-DATA SELANJUTNYA
	$sql2 = "UPDATE transaksi SET sisastok=sisastok-'$temp' WHERE iddetailbarang='$iddetailbarang' AND idtransaksi > '$idtransaksi'";
	$result2 = mysqli_query($connect,$sql2);
	
}else if ($qty<$qtytemp) {
	$temp = $qtytemp - $qty;
	$hsl = $stokasli + $temp;
	
	//UPDATE DATA-DATA SELANJUTNYA
	$sql2 = "UPDATE transaksi SET sisastok=sisastok+'$temp' WHERE iddetailbarang='$iddetailbarang' AND idtransaksi > '$idtransaksi'";
	$result2 = mysqli_query($connect,$sql2);
}

/*echo "<script type=\"text/javascript\">window.alert('".$qty."');</script>";
echo "<script type=\"text/javascript\">window.alert('".$qtytemp."');</script>";
echo "<script type=\"text/javascript\">window.alert('".$temp."');</script>";
echo "<script type=\"text/javascript\">window.alert('".$hsl."');</script>"; */

//UPDATE STOK MENU STOK BARANG
$sql = "UPDATE detailbarang SET stok='$hsl' where iddetailbarang=$iddetailbarang";
$result = mysqli_query($connect,$sql);

echo "<script type=\"text/javascript\">window.alert('Update Data Transaksi Berhasil.');window.location.href = 'admintransaksi.php';</script>";



mysqli_close($connect);
//echo "Succesfully edited";
//header("location: edit.php?product_id=$_POST[product_id]");

?> 
