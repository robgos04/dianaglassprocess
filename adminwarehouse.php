<?php
include("php/config.php");

function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "gudangceling");
	//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
	// $connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `produk` WHERE CONCAT(`namaproduk`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `produk`";
    $search_result = filterTable($query);
}
?>

<!DOCTYPE html>
<html>
<head>
<!--#JAVASCRIPT#-->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="css/style.css"></script>
<script src="bootstrap/js/moment.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap-datetimepicker.min.js"></script>

<!--#CSS#-->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
var angkasimpan=2;
$( document ).ready(function() {
	$("#dialog").hide();
	//$("#dialogbarang").hide();
});

$(document).on("click","#create-user",function() {
	$( "#dialog" ).dialog();
} );

//Fungsi Search
$(document).ready(function(){
    $('.search').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        $('#userTbl tbody tr').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    });
	
	var path = window.location.pathname.split("/");
	//console.log(path.length);
	var strippedPath = path.slice(path.length-1, path.length).join("/");
	
	var path1 = "/"+strippedPath;
	
	if("statuslogin" in localStorage){
    
		var pemakai = window.localStorage.getItem("statuslogin");
		
		
	}else if ("statusinventory" in localStorage) {
		 //alert("inventory");
		 var pemakai = window.localStorage.getItem("statusinventory");
		 //alert(pemakai);
		 document.getElementById("menu").children[2].style.display="none";
		 document.getElementById("menu").children[3].style.display="none";
		 document.getElementById("menu").children[4].style.display="none";
		 document.getElementById("menu").children[5].style.display="none";
		 document.getElementById("menu").children[6].style.display="none";
		 
		 if(path1 != "/admintransaksi.php" && path1 != "/adminstok.php"){
		     location.href = "admintransaksi.php";
		 }
		 
	}else if ("statussales" in localStorage) {
		//alert("sales");
		 var pemakai = window.localStorage.getItem("statussales");
		 //alert(pemakai);
		 document.getElementById("menu").children[0].style.display="none";
		 document.getElementById("menu").children[2].style.display="none";
		 document.getElementById("menu").children[3].style.display="none";
		 document.getElementById("menu").children[4].style.display="none";
		 document.getElementById("menu").children[5].style.display="none";
		 document.getElementById("menu").children[6].style.display="none";
		 $("#daftar").hide();
		 
		 if(path1 != "/admincustomer.php" && path1 != "/adminstok.php"){
		     location.href = "adminstok.php";
		 }
		 
	}else if ("statussupervisor" in localStorage) {
	    
	    if(path1 != "/admintransaksi.php" && path1 != "/adminstok.php" && path1 != "/admincustomer.php"){
		     location.href = "admintransaksi.php";
		 }
	    
	}else if ("statusinventoryoffice" in localStorage){
	    
	    if(path1 != "/admintransaksi.php" && path1 != "/adminstok.php" && path1 != "/admincustomer.php"){
		     location.href = "admintransaksi.php";
		 }
	    
	}else{
	    location.href="index.php";
	}
	
	$("#logout").click(function() {
	     alert("You've been logged out");
			window.localStorage.removeItem("statuslogin");
			window.localStorage.removeItem("statusinventory");
			window.localStorage.removeItem("statussales");
			window.location="index.php";
	});
	
	$("#pemakai").html("Hello,"+pemakai);
});
//$( function() {
    
//  } );

 </script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Diana Glass</a>
    </div>

	<ul class="nav navbar-nav navbar-left" id="menu">
		<li><a href="admintransaksi.php">History Transaksi</a></li>
		<li><a href="adminstok.php">Stok Barang</a></li>
		<li><a href="adminproduk.php">Produk</a></li>
        <li class="active"><a href="adminwarehouse.php">Warehouse</a></li>
        <li><a href="adminsupplier.php">Supplier</a></li>
		<li><a href="admincustomer.php">Customer</a></li>
		<li><a href="adminuser.php">User</a></li>
      </ul>
	
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><div id="pemakai"></div></a></li>
        <li><a href="#" id="logout">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	
<div class="col-md-12">	
		
		<h1> List Data Warehouse </h1>
		
		<div id="daftar">
			<button type="button" id="create-user" class="btn btn-primary" >Input Data Warehouse baru</button>
		</div>
		<br>
		
		<div id="dialog" title="Input Data Warehouse">
			<form action="inputwarehouse.php" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
				<table width="100%">
				<tr>
					<td>
					<i style="color:red;">* required</i>
					<br><br>
					<i style="color:black;">Nama Warehouse *</i><br>
					<input name="namawarehouse" type="text" placeholder="Nama Warehouse" class="form-control" id="namawarehouse">
					</td>
				</tr>
				<tr>
					<td><br>
					<i style="color:black;">Lokasi Warehouse</i><br>
					<input name="lokasiwarehouse" type="text" placeholder="Lokasi Warehouse" class="form-control" id="lokasiwarehouse">
					</td>
				</tr>
				<tr>	
					<td>
						<br>
						<button type="submit" class="btn btn-primary">Input</button>
					</td>
				</tr>
				</table>
			</form>
		</div>
		
	<div class="form-group pull-left">
			<input type="text" class="search form-control" placeholder="Search">
	</div>
	
	<div id='dialogbarang' title='Data Barang'>
	<div id="as"></div>
	</div>
		
	<?php
	$result = mysqli_query ($con,"select * from warehouse ORDER BY namawarehouse ASC ");
	
	echo	"<table class='table table-responsive table-bordered' id='userTbl'>";
	if (!empty($result))
	{
			echo "<thead>";
				echo "<tr class='newsnews1'>";
		/*	    echo "<th>";
				echo "<strong>ID Warehouse</strong>";
				echo "</th>"; */
				
				echo "<th class='tabjudul'>";
				echo "<strong>Nama Warehouse</strong>";
				echo "</th>";

				echo "<th  class='' style='width:200px;'>";
				echo "<strong>Lokasi Warehouse</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>View Barang</strong>";
				echo "</th>";
								
				echo "<th>";
				echo "<strong>Delete</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Edit All</strong>";
				echo "</th>";				
		
				echo "</tr>";
			echo "</thead>";
		
		while ($row=mysqli_fetch_array($result))
		{
			echo "<tr class=newsnews1>";
			
		/*	echo "<td>";
			echo $row['idwarehouse'];
			echo "</td>"; */
			
			echo "<td>";
			echo $row['namawarehouse'];
			echo "</td>";
			
			echo "<td class='tabdesk' style='width:200px;'>";
			echo $row['lokasiwarehouse'];
			echo "</td>";

			echo "<td>";
			echo "<a href='viewprodukbywarehouse.php?id=" . $row['idwarehouse'] ."'>";
			echo "<button type='submit' class='btn btn-primary btn-s'><span class='glyphicon glyphicon-eye-open'></span></button></form>";
			echo "</td>";
						
			echo "<td>";
			echo "<a href='deletewarehouse.php?id=" . $row['idwarehouse'] ."'>";
			echo "<button type='button' class='btn btn-danger btn-s'><span class='glyphicon glyphicon-trash'></span></button>";
			echo "</td>";
			
			echo "<td>";
			echo "<form action='editwarehouse.php' method='post'>";
			echo "<input type='hidden' name='id' value=".$row['idwarehouse']." ><button type='submit' class='btn btn-success btn-s'><span class='glyphicon glyphicon-pencil'></span></button></form>";
			echo "</td>";	
			
			echo "</tr>";
			
		}
			
	}
		
		
	?>
	
</div>


<?php
mysqli_close($con);

if(isset ($_GET['edit']))
{
	echo "<script> alert('Edit success'); </script>";
}
if(isset ($_GET['delete']))
{
	echo "<script> alert('Delete success'); </script>";
}
?>
</body>
</html>