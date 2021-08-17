<?php
	include("config.php");
	
	$sql = "select * from `warehouse` ORDER BY namawarehouse ASC";
	$result=mysqli_query($con,$sql);
	if (!empty($result))
	{
		
		while ($row=mysqli_fetch_array($result))
		{
			$warehouse[] = array(
			'idwarehouse' => $row['idwarehouse'],'namawarehouse' => $row['namawarehouse'], 'lokasiwarehouse' => $row['lokasiwarehouse']
			);
			
		}
	}

	mysqli_close($con);
	
	header('Content-Type:application/json');
	echo json_encode($warehouse);
?>