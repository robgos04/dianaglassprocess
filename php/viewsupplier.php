<?php
	include("config.php");
	
	$sql = "select * from `supplier` ORDER BY namasupplier ASC";
	$result=mysqli_query($con,$sql);
	if (!empty($result))
	{
		
		while ($row=mysqli_fetch_array($result))
		{
			$supplier[] = array(
			'idsupplier' => $row['idsupplier'],'namasupplier' => $row['namasupplier'], 'alamat' => $row['alamat'], 'contactperson' => $row['contactperson'], 'notelepon' => $row['notelepon']
			);
			
		}
	}

	mysqli_close($con);
	
	header('Content-Type:application/json');
	echo json_encode($supplier);
?>