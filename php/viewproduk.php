<?php
	include("config.php");
	
	$sql = "select * from `produk` order by namaproduk ASC";
	$result=mysqli_query($con,$sql);
	if (!empty($result))
	{
		
		while ($row=mysqli_fetch_array($result))
		{
			$produk[] = array(
			'idproduk' => $row['idproduk'], 'kodeproduk' => $row['kodeproduk'], 'namaproduk' => $row['namaproduk'],  'deskripsi' => $row['deskripsi'], 'harga' => $row['harga']
			);
			
		}
	}

	mysqli_close($con);
	
	header('Content-Type:application/json');
	echo json_encode($produk);
?>