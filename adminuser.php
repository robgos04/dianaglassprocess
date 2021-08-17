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
		 
<script type="text/javascript">


$( document ).ready(function() {

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


	$("#dialog").hide();
	
	$("#logout").click(function() {
	     alert("You've been logged out");
			window.localStorage.removeItem("statuslogin");
			window.localStorage.removeItem("statusinventory");
			window.localStorage.removeItem("statussales");
			window.location="index.php";
	});
	
	$("#pemakai").html("Hello,"+pemakai);
	
});

$(document).on("click","#create-user",function() {
	$( "#dialog" ).dialog();
} );

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
        <li><a href="adminwarehouse.php">Warehouse</a></li>
        <li><a href="adminsupplier.php">Supplier</a></li>
		<li><a href="admincustomer.php">Customer</a></li>
		<li class="active"><a href="adminuser.php">User</a></li>
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
		
		<h1>List Data User </h1>
		
		<div id="daftar">
			<button type="button" id="create-user" class="btn btn-primary" >Input User baru</button>
			<a href="extension.php"><button type="button" class="btn btn-warning" >Backup Database</button></a>
		</div>
		<br>
		
		<div id="dialog" title="Register New User">
			<form action="inputuser.php" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
				<table width="100%">
				<tr>
					<td><br>
					<i style="color:black;">Email</i><br>
					<input name="email" type="text" placeholder="Email" class="form-control" id="email">
					</td>
				</tr>
				<tr>
					<td><br>
					<i style="color:black;">Username</i><br>
					<input name="username" type="text" placeholder="Username" class="form-control" id="username">
					</td>
				</tr>
				<tr>
					<td><br>
					<i style="color:black;">Password</i><br>
					<input name="password" type="password" placeholder="Password" class="form-control" id="password">
					</td>
				</tr>
				<tr>	
					<td><br>
					<i style="color:black;">Role User</i><br>
					<!-- <input type="hidden" placeholder="Warehouse" id="gudang" name="gudang" class="form-control"> -->
					<select name="role1" id="role1" class="form-control">
						   <option selected>- Role -</option> 			  
						   <option name="manager" value="manager">Manager</option>
						   <option name="supervisor" value="supervisor">Supervisor</option>
						   <option name="sales" value="sales">Sales</option>
						   <option name="inventory" value="inventory">Inventory</option>
						   <option name="inventory_office" value="inventory_office">Inventory Office</option>
					</select>
					</td>
				</tr>
				<tr>	
					<td>
						<br>
						<button type="submit" class="btn btn-primary">Register</button>
					</td>
				</tr>
				</table>
			</form>
		</div>

	<?php
	$result = mysqli_query ($con,"select * from user ");
	echo	"<table class='table table-responsive table-bordered'>";
	if (!empty($result))
	{
		echo "<tr class='newsnews1'>";
				echo "<td>";
				echo "<strong>ID User</strong>";
				echo "</td>";
				
				echo "<td class='tabjudul'>";
				echo "<strong>Username</strong>";
				echo "</td>";

			/*	echo "<td class='' style='width:200px;'>";
				echo "<strong>Email</strong>";
				echo "</td>"; */
						
				echo "<td>";
				echo "<strong>Password</strong>";
				echo "</td>";
				
				echo "<td>";
				echo "<strong>Role</strong>";
				echo "</td>";
				
				echo "<td>";
				echo "<strong>Delete</strong>";
				echo "</td>";
				
				echo "<td>";
				echo "<strong>Edit</strong>";
				echo "</td>";
				
		
		echo "</tr>";
		
		while ($row=mysqli_fetch_array($result))
		{
			
			echo "<tr class=newsnews1>";
			
			echo "<td>";
			echo $row['iduser'];
			echo "</td>";
			
			echo "<td class='tabjudul'>";
			echo $row['username'];
			echo "</td>";

		/*	echo "<td class='tabdesk' style='width:200px;'>";
			echo $row['email'];
			echo "</td>"; */
			
			echo "<td>";
			echo $row['password'];
			echo "</td>";
			
			echo "<td>";
			echo $row['statususer'];
			echo "</td>";
			
			echo "<td>";
			echo "<a href='deleteuser.php?id=" . $row['iduser'] ."'>";
			echo "<button type='button' class='btn btn-danger btn-s'><span class='glyphicon glyphicon-trash'></span></button>";
			echo "</td>";
			
			echo "<td>";
			echo "<form action='edituser.php' method='post'>";
			echo "<input type='hidden' name='id' value=".$row['iduser']." ><button type='submit' class='btn btn-success btn-s'><span class='glyphicon glyphicon-pencil'></span></button></form>";
			echo "</td>";	
			
			echo "</tr>";
			
		}
	}
		echo"</table>";
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