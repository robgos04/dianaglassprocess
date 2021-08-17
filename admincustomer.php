<?php
include("php/config.php");

function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "gudangceling");
	//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
    //$connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");
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

$(document).ready(function(){
    
    $(window).on('load', function() {
			$("body").fadeIn(500);
	 });
    
    //Fungsi Search
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
		 document.getElementById("menu").children[6].style.display="none";
		 //$("#daftar").hide();
		 $(".delete").hide();
		 
		 if(path1 != "/admincustomer.php" && path1 != "/adminstok.php"){
		     location.href = "adminstok.php";
		 }
		 
	}else if ("statussupervisor" in localStorage) {
		//alert("sales");
		 var pemakai = window.localStorage.getItem("statussupervisor");
		 //alert(pemakai);
		 document.getElementById("menu").children[2].style.display="none";
		 document.getElementById("menu").children[3].style.display="none";
		 document.getElementById("menu").children[4].style.display="none";
		 document.getElementById("menu").children[6].style.display="none";
		 //$("#delete").hide();
		 $(".delete").hide();
		 //$("#daftar").hide();
		 
		 if(path1 != "/admintransaksi.php" && path1 != "/adminstok.php" && path1 != "/admincustomer.php"){
		     location.href = "admintransaksi.php";
		 }
		 
	}else if ("statusinventoryoffice" in localStorage) {
		 //alert("inventory");
		 var pemakai = window.localStorage.getItem("statusinventoryoffice");
		 //alert(pemakai);
		 document.getElementById("menu").children[2].style.display="none";
		 document.getElementById("menu").children[3].style.display="none";
		 document.getElementById("menu").children[4].style.display="none";
		 document.getElementById("menu").children[6].style.display="none";
		 $(".delete").hide();
		 $("#create-user").hide();
		 $(".hideinvenoffice").hide();
		 
		 if(path1 != "/admintransaksi.php" && path1 != "/adminstok.php" && path1 != "/admincustomer.php"){
		     location.href = "admintransaksi.php";
		 }
		 //console.log(path1);
		 
	} else {
        location.href="index.php";
    }

	$("#logout").click(function() {
	        alert("You've been logged out");
			window.localStorage.removeItem("statuslogin");
			window.localStorage.removeItem("statusinventory");
			window.localStorage.removeItem("statussales");
			window.localStorage.removeItem("statussupervisor");
			window.localStorage.removeItem("statusinventoryoffice");
			window.location="index.php";
	});
	
	$("#pemakai").html("Hello,"+pemakai);
	$("#usertransaksi").val(pemakai);
	
});
//$( function() {
    
//  } );

 </script>
   <style>
     body {
  display: none;
}
 </style>
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
        <li><a href="adminwarehouse.php">Warehouse</a></li>
        <li><a href="adminsupplier.php">Supplier</a></li>
		<li class="active"><a href="admincustomer.php">Customer</a></li>
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
		
		<h1>List Data Customer </h1>
		
		<div id="daftar">
			<button type="button" id="create-user" class="btn btn-primary" >Input Data Customer baru</button>
		</div>
		<br>
		
		<div id="dialog" title="Input Data Customer">
			<form action="inputcustomer.php" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
				    
				    <label style="font-style: italic;color:red;">* required</label>
				    <br>
					<label style="font-style: italic;">Nama Customer *</label>
					<input name="namacustomer" type="text" placeholder="Nama Customer" class="form-control" id="namacustomer">
					<br>
					<label style="font-style: italic;">Alamat *</label>
					<input name="alamatcustomer" type="text" placeholder="Alamat Customer" class="form-control" id="alamatcustomer">
					<br>
					<label style="font-style: italic;">Contact person</label>
					<input name="contactpersoncustomer" type="text" placeholder="Nama contact person" class="form-control" id="contactpersoncustomer">
					<br>
					<label style="font-style: italic;">No Telepon *</label>
					<input name="notelpcustomer" type="text" placeholder="Nomor telepon" class="form-control" id="notelpcustomer">
					
					<input name="usertransaksi" type="hidden" placeholder="user transaksi" class="form-control" id="usertransaksi">
					
						<br>
						<button type="submit" class="btn btn-primary">Input</button>
					
			</form>
		</div>
		
	<div class="form-group pull-right delete">
	<button onclick="Export()" class="btn btn-success">Export to CSV File</button> 
	</div>
	
	<script>
        function Export()
        {
            var conf = confirm("Export Data Customer to CSV?");
            if(conf == true)
            {
                window.open("exportcustomer.php", '_blank');
            }
        }
	</script>
		
	<div class="form-group pull-left">
			<input type="text" class="search form-control" placeholder="Search">
	</div>
	
	<div id='dialogbarang' title='Data Barang'>
	<div id="as"></div>
	</div>
	
	<style>
    
    .scroll {
    height: 500px;
    }
    table {
        display: flex;
        flex-flow: column;
        height: 100%;
        width: 100%;
    }
    table thead {
        /* head takes the height it requires, 
        and it's not scaled when table is resized */
        flex: 0 0 auto;
        width: calc(100% - 1.05em);
        display: table;
        table-layout: fixed;
    }
    table tbody {
        /* body takes all the remaining available space */
        flex: 1 1 auto; 
        display: block;
        overflow-y: scroll;
        
    }
    table tbody tr {
        width: 100%;
    }
    
    table tbody tr {
        display: table;
         width: 100%;
        table-layout: fixed;
    }
    /* decorations */
    .scroll {
        padding: 0.3em;
    }
    table {
        border: 1px solid lightgrey;
    }
    table td, table th {
        padding: 0.3em;
        border: 1px solid lightgrey;
    }
    table th {
        border: 1px solid grey;
    }
    
    
    </style>
		
	<?php
	$result = mysqli_query ($con,"select * from customer ORDER BY idcustomer DESC ");
	
	echo	"<table class='table table-responsive table-bordered scroll' id='userTbl'>";
	if (!empty($result))
	{
			echo "<thead>";
				echo "<tr class='newsnews1'>";
				echo "<th>";
				echo "<strong>ID Customer</strong>";
				echo "</th>";
				
				echo "<th class='tabjudul'>";
				echo "<strong>Nama Customer</strong>";
				echo "</th>";

				echo "<th  class='' style='width:200px;'>";
				echo "<strong>Alamat</strong>";
				echo "</th>";
				
				echo "<th class='tabjudul'>";
				echo "<strong>Contact person</strong>";
				echo "</th>";
				
				echo "<th class='tabjudul'>";
				echo "<strong>No Telepon</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>User</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Tanggal Update</strong>";
				echo "</th>";
								
				echo "<th class='delete'>";
				echo "<strong>Delete</strong>";
				echo "</th>";
				
				echo "<th class='hideinvenoffice'>";
				echo "<strong>Edit All</strong>";
				echo "</th>";				
		
				echo "</tr>";
			echo "</thead>";
		
		while ($row=mysqli_fetch_array($result))
		{
			echo "<tr class=newsnews1>";
			
			echo "<td>";
			echo $row['idcustomer'];
			echo "</td>";
			
			echo "<td>";
			echo $row['namacustomer'];
			echo "</td>";
			
			echo "<td class='tabdesk' style='width:200px;'>";
			echo $row['alamatcustomer'];
			echo "</td>";
			
			echo "<td>";
			echo $row['contactpersoncustomer'];
			echo "</td>";
			
			echo "<td>";
			echo $row['notelpcustomer'];
			echo "</td>";

            echo "<td>";
			echo $row['userupdate'];
			echo "</td>";
			
			echo "<td>";
			echo $row['tanggalupdatecustomer'];
			echo "</td>";
			
			echo "<td class='delete'>";
			echo "<a href='deletecustomer.php?id=" . $row['idcustomer'] ."'>";
			echo "<button type='button' class='btn btn-danger btn-s'><span class='glyphicon glyphicon-trash'></span></button>";
			echo "</td>";
			
			echo "<td class='hideinvenoffice'>";
			echo "<form action='editcustomer.php' method='post'>";
			echo "<input type='hidden' name='id' value=".$row['idcustomer']." ><button type='submit' class='btn btn-success btn-s'><span class='glyphicon glyphicon-pencil'></span></button></form>";
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