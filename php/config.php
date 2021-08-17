<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-HTTP-Method");
//header("Content-Type: application/json");

$con = mysqli_connect("localhost","root","","gudangceling"); //konek ke localhost
//$con = mysql_connect("140.118.110.32:53306","idsl_test","idsl_web_service"); //konek ke localhost
//$con = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass"); //konek ke localhost

if(!$con)
{
	die('coult not connect' . mysqli_connect_error()); 
}

//mysql_select_db("bookdatabase",$con); //nama database
//mysql_select_db("idsl_web_service",$con); //nama database

?>