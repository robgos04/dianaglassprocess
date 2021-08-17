<?php
include("php/config.php");

function filterTable($query)
{
    //$connect = mysqli_connect("localhost", "root", "", "gudangceling");
	//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
	 $connect = mysqli_connect("localhost","u6432664_renedew","tetsu13243546","u6432664_dianaglass");
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

$( document ).ready(function() {
	$("#dialog").hide();
	$("#dialogstok").hide();
	$("#dialogket").hide();
});

$(document).on("click","#create-user",function() {
	$( "#dialog" ).dialog();
} );


function klikstok(angka,idangka) {
	$( '#dialogstok' ).dialog();
	$("#stok1").val(angka);
	$("#idproduk1").val(idangka);
}

function liatdeskripsi(code,name,desc) {
	$( '#dialogket' ).dialog();
	$("#code").html("Kode Barang: "+code);
	$("#name").html("Nama Barang: "+name);
	$("#desc").html("Deskripsi: "+desc);
	//$("#price").html("Harga: "+price);
}

$(document).ready(function(){

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


$("#pemakai").html("Hello,"+pemakai);

$("#logout").click(function() {
	         alert("You've been logged out");
			window.localStorage.removeItem("statuslogin");
			window.localStorage.removeItem("statusinventory");
			window.localStorage.removeItem("statussales");
			window.localStorage.removeItem("statussupervisor");
			window.location="index.php";
	});
  
	
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
      <a class="navbar-brand" href="#">Admin</a>
    </div>

	<ul class="nav navbar-nav navbar-left">
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
		$id=mysqli_real_escape_string($con,$_GET["id"]);
		$result = mysqli_query ($con,"SELECT * FROM `detailbarang`,`produk`,`warehouse` WHERE detailbarang.idwarehouse=warehouse.idwarehouse AND detailbarang.idproduk=produk.idproduk AND warehouse.idwarehouse='$id'");
		$value = mysqli_fetch_object($result);
		echo "<h1>Data Barang ".$value->namawarehouse."</h1>";
		?>
		
		<div id='dialogstok' title='Update jumlah stok'>
		<form action='updatestok.php' method='POST' class='form-horizontal' enctype='multipart/form-data' role='form'>
		<table width='100%'>
		<tr>
			<td><br>
			<b style="color:black;">Jumlah Stok sekarang: <div id="sisa"></div></b>
			</td>
		</tr>
		<tr>
			<td><br>
			<i style="color:black;">Update Stok</i><br>
			<input type="text" name="iddetailbarang1" id="iddetailbarang1">
			<input name="stok1" type="number" placeholder="Stok" class="form-control" id="stok1">
			</td>
		</tr>
		<tr>
			<td>
				<br><button type='submit' class='btn btn-primary'>Update</button>
			</td>
		</tr>
		</table>
		</form>
		</div>
		
		<div id='dialogket' title='Detail Barang'>
			<div id="code"></div><br>
			<div id="name"></div><br>
			<div id="desc"></div><br>
			<!--<div id="price"></div>-->
		</div>
		
	<div class="form-group pull-left">
			<input type="text" class="search form-control" placeholder="Search">
	</div>&nbsp
	<a href="adminwarehouse.php"><button type="button" id="create-user" class="btn btn-primary" >Back to Data Warehouse</button></a>
	
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
	
	/*$id=mysqli_real_escape_string($con,$_GET["id"]);
	$result = mysqli_query ($con,"SELECT * FROM `detailbarang`,`produk`,`warehouse` WHERE detailbarang.idproduk=produk.idproduk AND detailbarang.idwarehouse=warehouse.idwarehouse AND detailbarang.idwarehouse='$id'"); */
	
	echo	"<table class='table table-responsive table-bordered scroll' id='userTbl'>";
	if (!empty($result))
	{
			echo "<thead>";
				echo "<tr>";
				echo "<th>";
				echo "<strong>ID Detail</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Kode Barang</strong>";
				echo "</th>";
				
				echo "<th class='tabjudul'>";
				echo "<strong>Nama Barang</strong>";
				echo "</th>";

				echo "<th class='tabdesk' style='width:70px;'>";
				echo "<strong>Jumlah Stok (pcs)</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Lokasi gudang</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>User Update</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Tanggal Update</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Edit All</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Delete</strong>";
				echo "</th>";				
		
				echo "</tr>";
			echo "</thead>";
		
		while ($row=mysqli_fetch_array($result))
		{
			echo "<tr>";
			
			echo "<td id='idcari'>";
			echo $row['iddetailbarang'];
			echo "</td>";
			
			echo "<td>";
			echo $row['kodeproduk'];
			echo "</td>";
			
			echo "<td>";
			echo $row['namaproduk'];
			$kodebar = $row['kodeproduk'];
			$namabar = $row['namaproduk'];
			$deskripsi = $row['deskripsi'];
			echo "<br><button type='submit' class='btn btn-success btn-s' onclick='liatdeskripsi(\"$kodebar\",\"$namabar\",\"$deskripsi\")'><span class='glyphicon glyphicon-eye-open'></span></button></form>";
			echo "</td>";

			echo "<td class='tabdesk' style='width:70px;'>";
			echo $row['stok'];
			echo "<br><button type='submit' class='btn btn-success btn-s' onclick='klikstok(".$row['stok'].",".$row['iddetailbarang'].")'><span class='glyphicon glyphicon-pencil'></span></button></form>";
			echo "</td>";
			
			echo "<td>";
			echo $row['namawarehouse'];
			echo "</td>";
			
			echo "<td>";
			echo $row['userstok'];
			echo "</td>";
			
			echo "<td>";
			echo $row['tanggalupdate'];
			echo "</td>";
			
			echo "<td>";
			echo "<form action='editdetail.php' method='post'>";
			echo "<input type='hidden' name='id' value=".$row['iddetailbarang']." ><button type='submit' class='btn btn-success btn-s'><span class='glyphicon glyphicon-pencil'></span></button></form>";
			echo "</td>";	
			
			echo "<td>";
			echo "<a href='deletedetail.php?id=" . $row['iddetailbarang'] ."'>";
			echo "<button type='button' class='btn btn-danger btn-s'><span class='glyphicon glyphicon-trash'></span></button>";
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