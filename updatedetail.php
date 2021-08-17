<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","","gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//mysqli_select_db("flight1",$connect);
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$iddetailbarang = $_POST['iddetailbarang'];
$keterangan = $_POST['ket1']." (Update)";

$result = mysqli_query ($connect,"SELECT * from detailbarang where iddetailbarang=$iddetailbarang");
$value = mysqli_fetch_object($result);
$stoksebelumnya = $value->stok;

$idproduk = $_POST['idproduk'];
$idsupplier = $_POST['idsupplier'];
$idwarehouse = $_POST['gudang'];

$date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
$tanggal = $date->format('Y-m-d H:i:s');

$update = $_POST['stok'];
$userstok = $_POST['userstok2'];
$hsl = $stoksebelumnya - $update;

if($hsl<0) {
	$qty = $update - $stoksebelumnya;
	$ket = 1; //In
} elseif ($hsl==0) {
	$qty = $hsl;
	$ket = 0;
} elseif ($hsl>0) {
	$qty = $hsl;
	$ket = 4; //Out
}

$sql = "UPDATE detailbarang SET idproduk='$idproduk', stok='$update', idwarehouse='$idwarehouse', idsupplier='$idsupplier', userstok='$userstok', tanggalupdate='$tanggal' where iddetailbarang=$iddetailbarang";


if($hsl!=0) {
	//echo "<script type=\"text/javascript\">window.alert('".$hsl."');</script>";
	
	if (mysqli_connect_errno())
    {
    	echo "Failed to connect to MySQL" .
    	mysqli_connect_error();
    }

	$sql1 = "INSERT INTO transaksi (`iddetailbarang`, `qty`, `keterangan`, `sisastok`, `customer`, `usertransaksi`, `tanggaltransaksi`) VALUES ('$iddetailbarang', '$qty', '$ket', '$update', '$keterangan', '$userstok', '$tanggal')";
	mysqli_query($connect,$sql1);
}

if(mysqli_query($connect,$sql)) {
	echo "<script type=\"text/javascript\">window.alert('Update Detail Barang Berhasil.');window.location.href = 'adminstok.php';</script>"; 
	//header("location: adminuser.php");
}
else {
//	header("location: detail.php?res=gagal&profile_nama=$_POST[username]&profile_id=$_POST[profile_id]");
}

mysql_close($connect);
//echo "Succesfully edited";
//header("location: edit.php?product_id=$_POST[product_id]");

?> 
