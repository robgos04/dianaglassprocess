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
<script src="js/allvar.js"></script>
		 
<script type="text/javascript">
//var host="https://libraryrobertcom.000webhostapp.com";
//var host="http://localhost/gudangceling";
//var host="http://www.dianaglassprocessing.co.id";

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
 
$(document).ready(function(){
  
	document.getElementById('gudang1').onchange = function () { // <-- Untuk pilih gudang
			document.getElementById('gudang').value = event.target.value }
  
	//View list gudang
	var id1=getUrlParameter("idwarehouse");
	
	$.ajax({
		url: host+'/php/viewwarehouse.php',
		data: { "idwarehouse": id1},
		dataType: 'json',
		success: function(data, status){
			//alert("success");
			$("#gudang1").html("<option selected>- Pilih Gudang -</option>");
			
			$.each(data, function(i,item){ 
				$("#gudang1").append("<option value='"+item.idwarehouse+"'>"+item.namawarehouse+"</option>");
			});
			 //$('ul').listview('refresh');
		},
		error: function(){
			//alert("error");
			output.text('There was an error loading the data.');
		}
	})
	
	//View list supplier
	var id1=getUrlParameter("idsupplier");
	
	$.ajax({
		url: host+'/php/viewsupplier.php',
		data: { "idsupplier": id1},
		dataType: 'json',
		success: function(data, status){
			//alert("success");
			$("#supplier1").html("<option selected>- Pilih Supplier -</option>");
			
			$.each(data, function(i,item){ 
				$("#supplier1").append("<option value='"+item.idsupplier+"'>"+item.namasupplier+"</option>");
			});
			 //$('ul').listview('refresh');
		},
		error: function(){
			//alert("error");
			output.text('There was an error loading the data.');
		}
	})
	
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
	
	$("#userstok").val(pemakai);

	$("#logout").click(function() {
	         alert("You've been logged out");
			window.localStorage.removeItem("statuslogin");
			window.localStorage.removeItem("statusinventory");
			window.localStorage.removeItem("statussales");
			window.localStorage.removeItem("statussupervisor");
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
		<li class="active"><a href="adminstok.php">Stok Barang</a></li>
		<li><a href="adminproduk.php">Produk</a></li>
        <li><a href="adminwarehouse.php">Warehouse</a></li>
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
	
	$result = mysqli_query($con,"SELECT * FROM detailbarang,produk,warehouse where iddetailbarang =". $_POST['id'] ." AND detailbarang.idproduk=produk.idproduk AND detailbarang.idwarehouse=warehouse.idwarehouse ");
	$row = mysqli_fetch_array($result);
	?>
		<form action="updatedetail.php" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
			<table width="100%">
			<tr>
				<td>
				<h1> Edit Data Barang </h1>
				</td>
			</tr>
			<tr>
				<td><br>
				<input name="iddetailbarang" type="hidden" value="<?php echo $row['iddetailbarang'];?>" placeholder="iddetail" class="form-control" id="iddetailbarang">
				<i style="color:black;">Kode Barang: <?php echo $row['kodeproduk'];?></i><br>
				<input name="idproduk" type="hidden" value="<?php echo $row['idproduk'];?>" placeholder="idproduk" class="form-control" id="idproduk">
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Nama Barang: <?php echo $row['namaproduk'];?></i><br>
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Jumlah Stok</i><br>
				<input name="stok" type="text" value="<?php echo $row['stok'];?>" placeholder="Stok" class="form-control" id="stok">
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Keterangan</i><br>
				<input name="ket1" type="text" placeholder="Keterangan" class="form-control" id="ket1">
				</td>
			</tr>
			<tr>	
				<td><br>
				<i style="color:black;">Lokasi Barang</i><br>
				
				<input type="text" placeholder="Warehouse" id="gudang" name="gudang" class="form-control" value="<?php echo $row['idwarehouse'];?>">
				<select name="gudang1" id="gudang1" class="form-control">
				   <option selected>- Pilih Gudang -</option>
				</select>
				</td>
			</tr>
			<tr>	
				<td><br>
				<i style="color:black;">Supplier</i><br>
				
				<input type="text" placeholder="Warehouse" id="idsupplier" name="idsupplier" class="form-control" value="<?php echo $row['idsupplier'];?>">
				<select name="supplier1" id="supplier1" class="form-control">
				   <option selected>- Pilih Supplier -</option>
				</select>
				<input type="hidden" name="userstok2" id="userstok">
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