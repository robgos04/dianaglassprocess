<?php
	include("config.php");
	
	$idbarang=$_POST['idproduk1'];
	$idwarehouse=$_POST['idwarehouse1'];
	//echo "<script type=\"text/javascript\">window.alert('".$idbarang."');</script>";
	//echo "<script type=\"text/javascript\">window.alert('".$idwarehouse."');</script>";
	
	$sql = "select *, sum(stok) as jumlahstok from `detailbarang` where idproduk='$idbarang' AND idwarehouse='$idwarehouse'";
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
			$order[] = array(
			'iddetailbarang' => $row['iddetailbarang'],'idproduk' => $row['idproduk'], 'idwarehouse' => $row['idwarehouse'], 'stok' => $row['stok'], 'userstok' => $row['userstok'], 'tanggalupdate' => $row['tanggalupdate'], 'jumlahstok' => $row['jumlahstok']
			);
		}
	}

	//mysqli_close($con);
	
	if($count==1)
	{
	header('Content-Type:application/json');
	echo json_encode($order); } 
?>