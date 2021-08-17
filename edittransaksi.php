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
	 $(".delete").hide();
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
		 //$("#daftar").hide();
		 $(".delete").hide();
}
	
	//Fungsi Untuk masukkan namacustomer sesuai pilihan di optionselect
	document.getElementById('customer1').onchange = function () { // <-- Untuk pilih customer
		document.getElementById('ketcustomer').value = event.target.value }
	
	//View list Customer
	var id1=getUrlParameter("idcustomer");
	
	$.ajax({
		url: host+'/php/viewcustomer.php',
		data: { "idcustomer": id1},
		dataType: 'json',
		success: function(data, status){
			//alert("success");
			$("#customer1").html("<option selected>- List Customer -</option>");
			
			$.each(data, function(i,item){ 
				$("#customer1").append("<option value='"+item.namacustomer+"'>"+item.namacustomer+"</option>");
			});
			 //$('ul').listview('refresh');
		},
		error: function(){
			//alert("error");
			output.text('There was an error loading the data.');
		}
	})

	$("#logout").click(function() {
	        alert("You've been logged out");
			window.localStorage.removeItem("statuslogin");
			window.localStorage.removeItem("statusinventory");
			window.localStorage.removeItem("statussales");
			window.localStorage.removeItem("statussupervisor");
			window.location="index.php";
	});
	
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
		<li class="active"><a href="admintransaksi.php">History Transaksi</a></li>
		<li><a href="adminstok.php">Stok Barang</a></li>
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
	
	/*$result = mysqli_query($con,"SELECT * FROM detailbarang,produk,warehouse where iddetailbarang =". $_POST['id'] ." AND detailbarang.idproduk=produk.idproduk AND detailbarang.idwarehouse=warehouse.idwarehouse ");*/
	
	$result = mysqli_query($con,"select * from transaksi,detailbarang,produk,warehouse where transaksi.iddetailbarang=detailbarang.iddetailbarang AND detailbarang.idproduk=produk.idproduk AND detailbarang.idwarehouse=warehouse.idwarehouse AND transaksi.idtransaksi = ".$_POST['id']."");
	$row = mysqli_fetch_array($result);
	?>
		<form action="updatetransaksi.php" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
			<table width="100%">
			<tr>
				<td>
				<h1> Edit Data Transaksi </h1>
				</td>
			</tr>
			<tr>
				<td><br>
				<input name="idtransaksi" type="hidden" value="<?php echo $row['idtransaksi'];?>" placeholder="idtransaksi" class="form-control" id="idtransaksi">
				<i style="color:black;">Kode Barang: <?php echo $row['kodeproduk'];?></i><br>
				<input name="iddetail" type="hidden" value="<?php echo $row['iddetailbarang'];?>" placeholder="iddetail" class="form-control" id="iddetail">
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Nama Barang: <?php echo $row['namaproduk'];?></i><br>
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Warehouse: <?php echo $row['namawarehouse'];?></i><br>
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Stok Sekarang (REAL): <b style="color:red;">
				<?php
					$id=$row['iddetailbarang'];
					$result1 = mysqli_query ($con,"SELECT * FROM detailbarang where iddetailbarang='$id'");
					$value = mysqli_fetch_object($result1);
					echo $value->stok;
					$stokasli = $value->stok;
				?>
				 pcs</b></i>
				 <input name="stokasli" type="hidden" value="<?php echo $stokasli;?>" placeholder="stokasli" class="form-control" id="stokasli">
				 <br>
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Stok sebelum transaksi ini: <?php 
				$a = $row['sisastok'];
				$b = $row['qty'];
				$c = $a + $b;
				echo "<b>".$c." pcs</b>";
				?></i><br>
				<input name="stokawal" type="hidden" value="<?php 
				$a = $row['sisastok'];
				$b = $row['qty'];
				$c = $a + $b;
				echo $c;?>" placeholder="stokawal" class="form-control" id="stokawal">
				</td>
			</tr>
			<tr>
				<td><br>
				<i style="color:black;">Qty (Out<span class='glyphicon glyphicon-arrow-down' style='color:red;'></span>)</i><br>
				<input name="qty" type="text" value="<?php echo $row['qty'];?>" placeholder="qty" class="form-control" id="qty">
				<input name="qtytemp" type="hidden" value="<?php echo $row['qty'];?>" placeholder="qty" class="form-control" id="qtytemp">
				</td>
			</tr>
			<tr>	
					<td><br>
					<i style="color:black;">Customer?</i><br>
					<input type="text" placeholder="Warehouse" id="ketcustomer" name="ketcustomer" class="form-control" value="<?php echo $row['customer'];?>">
					<select name="customer1" id="customer1" class="form-control">
					   <option selected>- List Customer -</option>
					</select>
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