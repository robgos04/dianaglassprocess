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

		 
<script type="text/javascript">
 
$(document).ready(function(){

    //alert("haha");
  
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
	}else if ("statussupervisor" in localStorage) {
		//alert("sales");
		 var pemakai = window.localStorage.getItem("statussupervisor");
		 //alert(pemakai);
		 document.getElementById("menu").children[2].style.display="none";
		 document.getElementById("menu").children[3].style.display="none";
		 document.getElementById("menu").children[4].style.display="none";
		 document.getElementById("menu").children[6].style.display="none";
		 $("#daftar").hide();
	}

	$("#logout").click(function() {
	     alert("You've been logged out");
			window.localStorage.removeItem("statuslogin");
			window.localStorage.removeItem("statusinventory");
			window.localStorage.removeItem("statussales");
			window.localStorage.removeItem("statussupervisor");
			window.location="index.php";
	});
	
	//alert(pemakai);
	$("#pemakai").html("Hello,"+pemakai);
	$("#usertransaksi").val(pemakai);
  
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
	
		<?php
	/*$connect=mysqli_connect("localhost","root","");
	mysqli_select_db($connect,"flight1"); */
	
	$result = mysqli_query($con,"SELECT * FROM customer where idcustomer =". $_POST['id'] ." ");
	$row = mysqli_fetch_array($result);
	?>
		<form action="updatecustomer.php" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
			<table width="100%">
			<tr>
				<td>
				<h1> Edit Data Customer </h1>
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Nama Customer</i><br>
				<input type="hidden" name="idcustomer" value="<?php echo $row['idcustomer'];?>">
				<input name="namacustomer" type="text" value="<?php echo $row['namacustomer'];?>" placeholder="Nama customer" class="form-control" id="namacustomer">
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Alamat</i><br>
				<input name="alamatcustomer" type="text" value="<?php echo $row['alamatcustomer'];?>" placeholder="Alamat" class="form-control" id="alamatcustomer">
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Contact Person</i><br>
				<input name="contactpersoncustomer" type="text" value="<?php echo $row['contactpersoncustomer'];?>" placeholder="Contact Person" class="form-control" id="contactpersoncustomer">
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">No Telepon</i><br>
				<input name="notelpcustomer" type="text" value="<?php echo $row['notelpcustomer'];?>" placeholder="No Telepon" class="form-control" id="notelpcustomer">
				<input name="usertransaksi" type="hidden" placeholder="user transaksi" class="form-control" id="usertransaksi">
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