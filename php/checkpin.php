<?php
	include("config.php");
	
	$pin = $_POST['pass'];
	
	$sql = "select * from `users` where pin = '$pin'";
	$result=mysqli_query($con,$sql);
	if (!empty($result))
	{
		
		while ($row=mysqli_fetch_array($result))
		{
			$login[] = array(
			'id' => $row['id'], 'first_name' => $row['first_name'], 'last_name' => $row['last_name'], 'username' => $row['username'], 'password' => $row['password']
		);
			
		}
	}

	mysqli_close($con);
	
	header('Content-Type:application/json');
	echo json_encode($login);
?>