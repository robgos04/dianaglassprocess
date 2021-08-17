<?php
session_start();
//include("php/config.php");
$connect=mysqli_connect("localhost","root","","gudangceling");
//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
//mysqli_select_db("flight1",$connect);
//$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");

$idwarehouse = $_POST['idwarehouse'];
$namawarehouse = $_POST['namawarehouse'];
$lokasiwarehouse = $_POST['lokasiwarehouse'];

$sql = "UPDATE warehouse SET namawarehouse='$namawarehouse', lokasiwarehouse='$lokasiwarehouse' where idwarehouse=$idwarehouse";

if(mysqli_query($connect,$sql)) {
	echo "<script type=\"text/javascript\">window.alert('Update Data Warehouse Berhasil.');window.location.href = 'adminwarehouse.php';</script>"; 
	//header("location: adminuser.php");
}
else {
//	header("location: detail.php?res=gagal&profile_nama=$_POST[username]&profile_id=$_POST[profile_id]");
}

mysql_close($connect);
//echo "Succesfully edited";
//header("location: edit.php?product_id=$_POST[product_id]");

?> 
