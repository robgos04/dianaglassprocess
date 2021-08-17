<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","","gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//mysqli_select_db("flight1",$connect);
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$iddetailbarang = $_POST['iddetailbarang1'];
$keterangan = $_POST['ket1']." (Update)";

$result = mysqli_query ($connect,"SELECT * from detailbarang where iddetailbarang=$iddetailbarang");
$value = mysqli_fetch_object($result);
$stoksebelumnya = $value->stok; 

$date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
$tanggal = $date->format('Y-m-d H:i:s');

$usertransaksi = $_POST['userstok1'];
$update = $_POST['stok1'];
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

//$date = date('Y-m-d H:i:s');

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL" .
	mysqli_connect_error();
}

/*echo "<script type=\"text/javascript\">window.alert('".$stoksebelumnya."');</script>";
echo "<script type=\"text/javascript\">window.alert('".$update."');</script>";
echo "<script type=\"text/javascript\">window.alert('".$qty."');</script>"; 
echo "<script type=\"text/javascript\">window.alert('".$ket."');</script>"; */


$sql1="INSERT INTO transaksi (`iddetailbarang`, `qty`, `sisastok`, `keterangan`, `customer`, `usertransaksi`, `tanggaltransaksi`) VALUES ('$iddetailbarang', '$qty', '$update', '$ket', '$keterangan', '$usertransaksi', '$tanggal')";
$result1 = mysqli_query($connect,$sql1);

$sql = "UPDATE detailbarang SET stok='$update',userstok='$usertransaksi',tanggalupdate='$tanggal' where iddetailbarang=$iddetailbarang";
$result = mysqli_query($connect,$sql);

/*$sql1 = "INSERT INTO transaksi (`iddetailbarang`, `qty`, `keterangan`, `sisastok`, `tanggaltransaksi`) VALUES ('$iddetailbarang', '$qty', '$ket', '$update', NOW())"; 
*/

echo "<script type=\"text/javascript\">window.alert('Update jumlah stok Berhasil.');window.location.href = 'adminstok.php';</script>";

//if(mysqli_query($connect,$sql) || mysqli_query($connect,$sql1)) {
	 
	//header("location: adminuser.php");
//}
//else {} 

mysqli_close($connect);
//echo "Succesfully edited";
//header("location: edit.php?product_id=$_POST[product_id]");

?> 
