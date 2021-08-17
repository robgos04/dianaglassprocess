<?php
include("php/config.php");
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
	$(function() {
		var date = $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
	});
		 </script>
		 
<script type="text/javascript">
 
$(document).ready(function(){
  $("#buttontanggal").click(function(){
  $(".newsnews1").remove();
	  $.post("getnewsadmin.php",
		{
			tanggal:$('#cat').val(),
		},
		function(data,status){
		  $(".table-bordered tbody").append(data);
		});
		
  });
  
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
      <a class="navbar-brand" href="#">Admin</a>
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
	
		<?php
	/*$connect=mysqli_connect("localhost","root","");
	mysqli_select_db($connect,"flight1"); */
	
	$result = mysqli_query($con,"SELECT * FROM warehouse where idwarehouse =". $_POST['id'] ." ");
	$row = mysqli_fetch_array($result);
	?>
		<form action="updatewarehouse.php" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
			<table width="100%">
			<tr>
				<td>
				<h1> Edit Data Warehouse </h1>
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Nama Warehouse</i><br>
				<input type="hidden" name="idwarehouse" value="<?php echo $row['idwarehouse'];?>">
				<input name="namawarehouse" type="text" value="<?php echo $row['namawarehouse'];?>" placeholder="Nama warehouse" class="form-control" id="namawarehouse">
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Lokasi Warehouse</i><br>
				<input name="lokasiwarehouse" type="text" value="<?php echo $row['lokasiwarehouse'];?>" placeholder="lokasiwarehouse" class="form-control" id="lokasiwarehouse">
				</td>
			</tr>
			<tr>	
				<td>
				<br>
				<button type="submit" class="btn btn-primary">Update</button>
				</td>
			</tr>
			</table>
		</form>
		<br>

</div>

<?php
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