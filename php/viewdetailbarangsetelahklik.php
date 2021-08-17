<?php
	include("config.php");
	
	$idbarang=$_POST['idproduk1'];
	//echo "<script type=\"text/javascript\">window.alert('".$idbarang."');</script>";
	//echo "<script type=\"text/javascript\">window.alert('".$idwarehouse."');</script>";
	
	$sql = "SELECT * FROM `detailbarang`,`produk`,`warehouse`,`supplier` WHERE detailbarang.idproduk=produk.idproduk AND detailbarang.idwarehouse=warehouse.idwarehouse AND detailbarang.idsupplier=supplier.idsupplier AND detailbarang.idproduk='$idbarang' ORDER by detailbarang.iddetailbarang DESC";
	//$result=mysqli_query($con,$sql);
	//$count = mysqli_num_rows($result);
	
	$result=mysqli_query($con,$sql);
	if (!empty($result))
	{
		
		while ($row=mysqli_fetch_array($result))
		{
			$order[] = array(
			'iddetailbarang' => $row['iddetailbarang'], 'stok' => $row['stok'], 'userstok' => $row['userstok'], 'tanggalupdate' => $row['tanggalupdate'],
			'idproduk' => $row['idproduk'], 'kodeproduk' => $row['kodeproduk'], 'namaproduk' => $row['namaproduk'],  'deskripsi' => $row['deskripsi'], 'harga' => $row['harga'],
			'idsupplier' => $row['idsupplier'],'namasupplier' => $row['namasupplier'], 'alamat' => $row['alamat'], 'contactperson' => $row['contactperson'], 'notelepon' => $row['notelepon'],
			'idwarehouse' => $row['idwarehouse'],'namawarehouse' => $row['namawarehouse'], 'lokasiwarehouse' => $row['lokasiwarehouse']
			);
			
		}
	}

	//mysqli_close($con);
	
	header('Content-Type:application/json');
	echo json_encode($order); 
?>