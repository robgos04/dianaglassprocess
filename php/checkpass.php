<?php
	//if($_POST['mode']=="checkUsername"){
	//$username = $_POST['username'];
	include("config.php");
	
	if(isset($_POST['password']))
	{
		$password=$_POST['password'];
		
		//$uppercase = preg_match('@[A-Z]@', $password);
		//$lowercase = preg_match('@[a-z]@', $password);
		//$number    = preg_match('@[0-9]@', $password);

		if(strlen($password) < 6) {
			echo "<span style='color:red;'>Password minimum 6 characters</span>";
		}
		else
		{
			echo "<span style='color:green;'>Password OK</span>";
		}
			exit();
	}



?>