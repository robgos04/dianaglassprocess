<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","","gudangceling");
//mysqli_select_db($connect,"gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$idproduk = $_POST['idbarang'];

$stok = $_POST['stok2'];
$stoktambah = $_POST['stoktambah'];
$gudang = $_POST['gudang'];
$idsupplier = $_POST['idsupplier'];
$userstok = $_POST['userstok'];
$status = $_POST['status'];

$date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
$tanggal = $date->format('Y-m-d H:i:s');

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL" .
	mysqli_connect_error();
}

if($status=="On" || $idproduk=='- Pilih Barang -' || $gudang=='- Pilih Gudang -' || $idsupplier=='- Pilih Supplier -') {
	
	if ($idproduk=='- Pilih Barang -') {
		echo "<script type=\"text/javascript\">window.alert('Silahkan pilih Barang!');window.location.href = 'adminstok.php';</script>"; 
	}else if ($gudang=='- Pilih Gudang -') {
		echo "<script type=\"text/javascript\">window.alert('Silahkan pilih Gudang!');window.location.href = 'adminstok.php';</script>"; 
	}else if ($idsupplier=='- Pilih Supplier -') {
		echo "<script type=\"text/javascript\">window.alert('Silahkan pilih Supplier!');window.location.href = 'adminstok.php';</script>"; 
	}else if($status=='On') {
		//echo "<script type=\"text/javascript\">window.alert('Sudah ada Data Stok! Tidak perlu input data!');window.location.href = 'adminstok.php';</script>";
		$result3 = mysqli_query ($connect,"SELECT * FROM `detailbarang` WHERE detailbarang.idwarehouse='$gudang' AND detailbarang.idproduk='$idproduk'");
		$value3 = mysqli_fetch_object($result3);
		$id = $value3->iddetailbarang;
		
		$resultsupp = mysqli_query ($connect,"SELECT * FROM `supplier` WHERE idsupplier='$idsupplier'");
		$valuesupp = mysqli_fetch_object($resultsupp);
		$namasupp = $valuesupp->namasupplier;
		
		$keterangan = $_POST['ket2'].", ".$namasupp." (Supplier)";
		
		$sql2 = "UPDATE detailbarang SET stok='$stok'+'$stoktambah',idsupplier='$idsupplier', userstok='$userstok',tanggalupdate='$tanggal' where iddetailbarang=$id";
		$result2 = mysqli_query($connect,$sql2);
		
		$sql4="INSERT INTO transaksi (`iddetailbarang`, `qty`, `sisastok`, `keterangan`, `customer`, `usertransaksi`, `tanggaltransaksi`) VALUES ('$id', '$stoktambah', '$stok'+'$stoktambah', '1', '$keterangan', '$userstok', '$tanggal')";
		$result4 = mysqli_query($connect,$sql4);
		
		echo "<script type=\"text/javascript\">window.alert('Update Data Stok Berhasil.');window.location.href = 'adminstok.php';</script>";
	}
}else /*if ($status=="Off" && $idproduk!='- Pilih Barang -' && $gudang!='- Pilih Gudang -' && $idsupplier!='- Pilih Supplier -')*/ {
	$query="INSERT INTO detailbarang (`idproduk`, `stok`, `idwarehouse`, `idsupplier`, `userstok`, `tanggalupdate`) VALUES ('$idproduk', '$stoktambah', '$gudang', '$idsupplier', '$userstok', '$tanggal')";
	$result = mysqli_query($connect,$query);
	
	$result1 = mysqli_query ($connect,"SELECT * FROM `detailbarang`,`supplier` WHERE detailbarang.idwarehouse='$gudang' AND detailbarang.idproduk='$idproduk' AND detailbarang.idsupplier='$idsupplier' AND detailbarang.idsupplier=supplier.idsupplier");
	$value = mysqli_fetch_object($result1);
	$iddetail = $value->iddetailbarang;
	$namasupplier = $value->namasupplier; 
	
	$sql1 = "INSERT INTO transaksi (`iddetailbarang`, `qty`, `keterangan`, `sisastok`, `customer`, `usertransaksi`, `tanggaltransaksi`) VALUES ('$iddetail', '$stoktambah', '3', '$stok'+'$stoktambah', '$namasupplier', '$userstok', '$tanggal')";
	mysqli_query($connect,$sql1);
	
	echo "<script type=\"text/javascript\">window.alert('Input Data Stok Berhasil.');window.location.href = 'adminstok.php';</script>"; 
}
?>