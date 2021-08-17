<?php
	include("config.php");
	
	$sql = "select * from `customer` ORDER BY namacustomer ASC";
	$result=mysqli_query($con,$sql);
	if (!empty($result))
	{
		
		while ($row=mysqli_fetch_array($result))
		{
			$customer[] = array(
			'idcustomer' => $row['idcustomer'],'namacustomer' => $row['namacustomer'], 'alamatcustomer' => $row['alamatcustomer'], 'contactpersoncustomer' => $row['contactpersoncustomer'], 'notelpcustomer' => $row['notelpcustomer']
			);
			
		}
	}

	mysqli_close($con);
	
	header('Content-Type:application/json');
	echo json_encode($customer);
?>