<?php
	include("config.php");
	
	$username=$_POST['user'];
	$password=$_POST['pass'];
	//echo "<script type=\"text/javascript\">window.alert('".$idbarang."');</script>";
	//echo "<script type=\"text/javascript\">window.alert('".$idwarehouse."');</script>";
	
	$sql = "select * from `user` where username='$username' AND password='$password'";
	$result=mysqli_query($con,$sql);
	$count = mysqli_num_rows($result);
	
	/*if (!empty($result))
	{
		
		while ($row=mysqli_fetch_array($result))
		{
			$order[] = array(
			'iddetailbarang' => $row['iddetailbarang'],'idproduk' => $row['idproduk'], 'idwarehouse' => $row['idwarehouse'], 'stok' => $row['stok'], 'tanggalupdate' => $row['tanggalupdate']
			);
			
		}
	}*/
	
	if($count == 1)
	{
		while($row = mysqli_fetch_array($result))
		{
			$user[] = array(
			'iduser' => $row['iduser'],'username' => $row['username'], 'email' => $row['email'], 'password' => $row['password'], 'statususer' => $row['statususer']
			);
		}
	}

	//mysqli_close($con);
	
	if($count==1)
	{
	header('Content-Type:application/json');
	echo json_encode($user); } 
?>