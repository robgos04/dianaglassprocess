<?php
//include("config.php");

// Database configuration
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'gudangceling';

// Connect with the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 

// Get search term
$searchTerm = $_GET['term'];

// Get matched data from skills table
//$query = $db->query("SELECT * FROM skills WHERE skill LIKE '%".$searchTerm."%' AND status = '1' ORDER BY skill ASC");
$query = $db->query("SELECT * FROM produk WHERE namaproduk LIKE '%".$searchTerm."%' ORDER BY namaproduk ASC");

// Generate skills data array
/*$skillData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $data['id'] = $row['id'];
        $data['value'] = $row['skill'];
        array_push($skillData, $data);
    }
}*/

$skillData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $data['id'] = $row['idproduk'];
        $data['value'] = $row['namaproduk'];
        array_push($skillData, $data);
    }
}

// Return results as json encoded array
echo json_encode($skillData);

?>