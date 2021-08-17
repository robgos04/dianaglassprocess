<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","","gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//mysqli_select_db("flight1",$connect);
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$idsupplier = $_POST['idsupplier'];
$namasupplier = $_POST['namasupplier'];
$alamat = $_POST['alamat'];
$contactperson = $_POST['contactperson'];
$notelepon = $_POST['notelepon'];

$sql = "UPDATE supplier SET namasupplier='$namasupplier', alamat='$alamat', contactperson='$contactperson', notelepon='$notelepon' where idsupplier=$idsupplier";

if(mysqli_query($connect,$sql)) {
	echo "<script type=\"text/javascript\">window.alert('Update Data Supplier Berhasil.');window.location.href = 'adminsupplier.php';</script>"; 
	//header("location: adminuser.php");
}
else {
//	header("location: detail.php?res=gagal&profile_nama=$_POST[username]&profile_id=$_POST[profile_id]");
}

mysql_close($connect);
//echo "Succesfully edited";
//header("location: edit.php?product_id=$_POST[product_id]");

?> 
