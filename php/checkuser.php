<?php
	//if($_POST['mode']=="checkUsername"){
	//$username = $_POST['username'];
	include("config.php");
	
	if(isset($_POST['user_name']))
	{
		$name=$_POST['user_name'];

		$checkdata=" SELECT username FROM users WHERE username='$name' ";

		$query=mysqli_query($con,$checkdata);

		if(mysqli_num_rows($query)>0)
		{
			echo "<span style='color:red;'>Username Already Exist</span>";
		}
		else
		{
			echo "<span style='color:green;'>OK</span>";
		}
			exit();
	}



?>