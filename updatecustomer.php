<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","","gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//mysqli_select_db("flight1",$connect);
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$idcustomer = $_POST['idcustomer'];
$namacustomer = $_POST['namacustomer'];
$alamatcustomer = $_POST['alamatcustomer'];
$contactpersoncustomer = $_POST['contactpersoncustomer'];
$notelpcustomer = $_POST['notelpcustomer'];
$userupdate = $_POST['usertransaksi'];

$date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
$tanggal= $date->format('Y-m-d H:i:s');

$sql = "UPDATE customer SET namacustomer='$namacustomer', alamatcustomer='$alamatcustomer', contactpersoncustomer='$contactpersoncustomer', notelpcustomer='$notelpcustomer', userupdate='$userupdate', tanggalupdatecustomer='$tanggal' where idcustomer=$idcustomer";

if(mysqli_query($connect,$sql)) {
	echo "<script type=\"text/javascript\">window.alert('Update Data Customer Berhasil.');window.location.href = 'admincustomer.php';</script>"; 
	//header("location: adminuser.php");
}
else {
//	header("location: detail.php?res=gagal&profile_nama=$_POST[username]&profile_id=$_POST[profile_id]");
}

mysql_close($connect);
//echo "Succesfully edited";
//header("location: edit.php?product_id=$_POST[product_id]");

?> 
