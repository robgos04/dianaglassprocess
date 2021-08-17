<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","","gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//mysqli_select_db("flight1",$connect);
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$idproduk = $_POST['idproduk'];
$kodeproduk = $_POST['kodeproduk'];
$namaproduk = $_POST['namaproduk'];
$deskripsi = $_POST['deskripsi'];
//$harga = $_POST['harga'];

$sql = "UPDATE produk SET kodeproduk='$kodeproduk', namaproduk='$namaproduk', deskripsi='$deskripsi' where idproduk=$idproduk";

if(mysqli_query($connect,$sql)) {
	echo "<script type=\"text/javascript\">window.alert('Update Data Produk Berhasil.');window.location.href = 'adminproduk.php';</script>"; 
	//header("location: adminuser.php");
}
else {
//	header("location: detail.php?res=gagal&profile_nama=$_POST[username]&profile_id=$_POST[profile_id]");
}

mysql_close($connect);
//echo "Succesfully edited";
//header("location: edit.php?product_id=$_POST[product_id]");

?> 
