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

//echo "<script type=\"text/javascript\">window.alert(The Server time is '".date("h:i:sa")."');</script>";
$timezone = date_default_timezone_get();
//echo "The Server time is " . date("h:i:sa"). " ,".$timezone;

$date = new DateTime("now", new DateTimeZone('Asia/Makassar') );

//echo "Waktu di Makassar: ".$date->format('Y-m-d H:i:s');

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
<script src="js/allvar.js"></script>

<script type="text/javascript" charset="utf-8">
//var host="https://libraryrobertcom.000webhostapp.com";
//var host="http://localhost/gudangceling";
//var host="http://www.dianaglassprocessing.co.id";

//window.localStorage.removeItem("admin");




//var pemakai=window.localStorage.getItem("statuslogin");

var userlogin;
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

var angkasimpan=2;
$( document ).ready(function() {
	$("#dialog").hide();
	//$("#dialogbarang").hide();
	$("#dialogket").hide();
});

$(document).on("click","#create-user",function() {
	$( "#dialog" ).dialog();
} );

function getValuemember(val) {
		var myval=val.split('|');
        $('#idbarang').val(myval[0]);
        $(".skill_input").val(myval[1]);
		
		var a = document.getElementById('idbarang').value;
		var b = document.getElementById("gudang2").value;
		//alert(a);alert(b);
		dt={idproduk1:a,idwarehouse1:b};
		$.ajax({
			type: "POST",
			url: host+'/php/viewdatadetailbarang.php',
			data: dt,
			dataType: 'json',
			success:function (data, status) {
				
				jsonResult = data;
				userlogin=jsonResult[0];

				if(userlogin.idproduk && userlogin.idwarehouse) {
					//var x = ""+userlogin.stok;
					var x = ""+userlogin.stok;
					//alert(x);
					document.getElementById("jml").innerHTML = "Sisa Stok: " +x+" pcs";
					$("#iddetail").val(userlogin.iddetailbarang);
					$("#stok").val(x);
				}
			},
			error: function(){
				//alert("error barang");
				document.getElementById("jml").innerHTML = "Sisa Stok: 0 pcs";
			}
		});
}

var idproduk=0;
var idgudang=0;

function liatdeskripsi(code,name,desc) {
	$( '#dialogket' ).dialog();
	$("#code").html("Kode Barang: "+code);
	$("#name").html("Nama Barang: "+name);
	$("#desc").html("Deskripsi: "+desc);
	//$("#price").html("Harga: "+price);
}

function update(qty, keterangan, iddetail, idtrans) {
	//alert(qty);
	//alert(iddetail);
	//alert(idtrans);	
		var a=qty; var b=iddetail; var d=keterangan; var e=idtrans;
		var c = window.localStorage.getItem("statuslogin");
		//alert(a,b,c);
		dt={qty1:a,iddetail1:b,user:c,keterangan:d,idtransaksi:e};
		$.ajax({
			type: "GET",
			url: host+'/php/updatestokafterdelete.php',
			data: dt,
			dataType: 'json',
			success:function (data) {
				
			},
			error: function(){
				//alert("error Stok");
				alert('Transaction Cancel! Stock Updated');
				//output.text('There was an error loading the data.');
			}
		});
}

$(document).ready(function(){

$(window).on('load', function() {
			$("body").fadeIn(500);
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
	 
}else if ("statusinventoryoffice" in localStorage) {
	 //alert("inventory");
	 var pemakai = window.localStorage.getItem("statusinventoryoffice");
	 //alert(pemakai);
	 document.getElementById("menu").children[2].style.display="none";
	 document.getElementById("menu").children[3].style.display="none";
	 document.getElementById("menu").children[4].style.display="none";
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

$("#usertransaksi").val(pemakai);

//$('#jml').html("<b style='color:black;'>Sisa stok: - pcs</b>");

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
	
	//Fungsi Untuk cek Stok barang berdasarkan dari barang
	/*document.getElementById('member1').onchange = function () { // <-- Untuk pilih barang
		document.getElementById('idbarang').value = event.target.value
		$(".skill_input").val(event.target.value);		
			
		var a = document.getElementById('idbarang').value;
		var b = document.getElementById("gudang2").value;
		//alert(a);alert(b);
		dt={idproduk1:a,idwarehouse1:b};
		$.ajax({
			type: "POST",
			url: host+'/php/viewdatadetailbarang.php',
			data: dt,
			dataType: 'json',
			success:function (data, status) {
				
				jsonResult = data;
				userlogin=jsonResult[0];

				if(userlogin.idproduk && userlogin.idwarehouse) {
					var x = ""+userlogin.stok;
					//alert(x);
					document.getElementById("jml").innerHTML = "Sisa Stok: " +x+" pcs";
					$("#iddetail").val(userlogin.iddetailbarang);
					$("#stok").val(x);
				}
			},
			error: function(){
				//alert("error barang");
				document.getElementById("jml").innerHTML = "Sisa Stok: 0 pcs";
			}
		});
	} */
	
	//View list produk
	var id1=getUrlParameter("id");
	
	$.ajax({
		url: host+'/php/viewproduk.php',
		data: { "id": id1},
		dataType: 'json',
		success: function(data, status){
			//alert("success");
			$("#member1").html("<option selected>- Pilih Barang -</option>");
			$.each(data, function(i,item){ 
				$("#member1").append('<option value="'+item.idproduk+'|'+item.namaproduk+'">'+item.kodeproduk+' - '+item.namaproduk+'</option>');
				
			});
			 //$('ul').listview('refresh');
		},
		error: function(){
			//alert("error");
			output.text('There was an error loading the data.');
		}
	})
	
	//Fungsi Untuk cek Stok barang berdasarkan gudang
	document.getElementById('gudang1').onchange = function () { // <-- Untuk pilih gudang
		document.getElementById('gudang2').value = event.target.value 
			
		var a = $('#idbarang').val();
		var b = document.getElementById("gudang2").value;
		//alert(a);alert(b);
		dt={idproduk1:a,idwarehouse1:b};
		$.ajax({
			type: "POST",
			url: host+'/php/viewdatadetailbarang.php',
			data: dt,
			dataType: 'json',
			success:function (data, status) {
				
				jsonResult = data;
				userlogin=jsonResult[0];
				
				if(userlogin.idproduk && userlogin.idwarehouse) {
					//var x = ""+userlogin.stok;
					var x = ""+userlogin.stok;
					//alert(x);
					document.getElementById("jml").innerHTML = "Sisa Stok: " +x+" pcs";
					$("#iddetail").val(userlogin.iddetailbarang);
					$("#stok").val(x);
				}
				
			},
			error: function(){
				//alert("error gudang");
				document.getElementById("jml").innerHTML = "Sisa Stok: 0 pcs";
				//output.text('There was an error loading the data.');
			}
		});
			
	}
  
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
			window.localStorage.removeItem("statusinventoryoffice");
			window.location="index.php";
	});
	
	
//Fungsi Auto Complete Suggestion
	$(".skill_input").autocomplete({
			source: "php/suggestion.php",
			//source: [ "PHP", "Python", "Ruby", "JavaScript", "MySQL", "Oracle" ],
			select: function( event, ui ) {
				//event.preventDefault();
				$("#idbarang").val(ui.item.id);
			}
	});
	
});

 </script>
  <style>
 ul.ui-autocomplete {
    z-index: 1100;
}

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
		
		<h1> History Transaksi </h1>
		
		<div id="daftar">
			<button type="button" id="create-user" class="btn btn-primary" >Input Transaksi</button>
		</div>
		<br>
		
		
		<div id="dialog" title="Input Transaksi">
			<form action="inputtransaksi.php" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
				
					<label style="font-style: italic;">Barang ?</label>
					<div class="auto-widget">
						<p><input type="text" class="form-control skill_input" placeholder="Nama Produk"/></p>
					</div>
					Atau search by list<br>
					<input type="hidden" placeholder="Warehouse" id="idbarang" name="idbarang" class="form-control">
					<select name="member1" id="member1" onchange="getValuemember(this.value);" class="form-control">
						   <option selected>- Pilih Barang -</option>
					</select>
					<hr style='color:black;'>
					<label style="font-style: italic;">Warehouse?</label>
					<input type="hidden" placeholder="Warehouse" id="gudang2" name="gudang" class="form-control">
					<select name="gudang1" id="gudang1" class="form-control">
					   <option selected>- List Gudang -</option>
					</select>
					<hr>
					<b id="jml"></b>
					<input type="hidden" placeholder="stok" id="stok" name="stok" class="form-control">
					<input type="hidden" placeholder="ID Detail" id="iddetail" name="iddetail" class="form-control">
				    <hr>
					<label style="font-style: italic;">Qty (Out<span class='glyphicon glyphicon-arrow-down' style='color:red;'></span>)</label>
					<input name="qty" type="text" placeholder="Jumlah Qty" class="form-control" id="qty" autocomplete="off">
					<hr>
					<label style="font-style: italic;">Customer?</label>
					<input type="hidden" placeholder="Warehouse" id="ketcustomer" name="ketcustomer" class="form-control">
					<select name="customer1" id="customer1" class="form-control">
					   <option selected>- List Customer -</option>
					</select>
					<input name="usertransaksi" type="hidden" placeholder="user transaksi" class="form-control" id="usertransaksi">
					<hr>
					<label style="font-style: italic;">Keterangan Transaksi:</label>
					<input name="ket2" type="text" placeholder="Keterangan" class="form-control" id="ket2">
					<br>
					<p>
						<button type="submit" class="btn btn-primary">Input</button>
					</p>
				
			</form>
		</div>
		
		<div id='dialogket' title='Detail Barang'>
			<div id="code"></div><br>
			<div id="name"></div><br>
			<div id="desc"></div><br>
			<!--<div id="price"></div>-->
		</div>
	
	<div class="form-group pull-right delete">
	<button onclick="Export()" class="btn btn-success">Export to CSV File</button> 
	</div>
	
	<script>
        function Export()
        {
            var conf = confirm("Export Data Transaksi to CSV?");
            if(conf == true)
            {
                window.open("exporttransaksi.php", '_blank');
            }
        }
		
		$(document).ready(function(){
            $('.pagination').pagination({
                    items: <?php echo $total_records;?>,
                    itemsOnPage: <?php echo $limit;?>,
                    cssStyle: 'light-theme',
                    currentPage : <?php echo $page;?>,
                    hrefTextPrefix : 'admintransaksi.php?page='
                });
        });
	</script>
		
	<div class="form-group pull-left">
			<input type="text" class="search form-control" placeholder="Search">
	</div>
	
	<br>
	
	<!--
	<div id='dialogbarang' title='Data Barang'>
	<div id="as"></div>
	</div> -->

	<div class="posisi">	
	<?php
	
	$limit = 5;  
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
	$start_from = ($page-1) * $limit;  
	
	$result = mysqli_query ($con,"select * from transaksi,detailbarang,produk,warehouse where transaksi.iddetailbarang=detailbarang.iddetailbarang AND detailbarang.idproduk=produk.idproduk AND detailbarang.idwarehouse=warehouse.idwarehouse ORDER BY transaksi.idtransaksi DESC LIMIT $start_from, $limit");
	
	echo	"<table class='table table-responsive table-bordered scroll' id='userTbl'>";
	if (!empty($result))
	{       
	        echo "<div class='posisi1'>";
			echo "<thead>";
				echo "<tr class=newsnews1>";
				echo "<th>";
				echo "<strong>ID Transaksi</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Kode Barang</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Nama Barang</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Warehouse</strong>";
				echo "</th>";

				echo "<th>";
				echo "<strong>Qty (In<span class='glyphicon glyphicon-arrow-up' style='color:green;'></span>/Out<span class='glyphicon glyphicon-arrow-down' style='color:red;'></span>)</strong>";
				echo "</th>";
				
				echo "<th class='delete'>";
				echo "<strong>Sisa Stok sekarang</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Keterangan</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>User</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Tanggal Transaksi</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>View Barang</strong>";
				echo "</th>";
								
				echo "<th class='delete' id='delete3'>";
				echo "<strong>Delete</strong>";
				echo "</th>";
				
				echo "<th class='delete' id='delete3'>";
				echo "<strong>Edit</strong>";
				echo "</th>";
		
				echo "</tr>";
			echo "</thead>";
		
		
		while ($row=mysqli_fetch_array($result))
		{
			echo "<tr class=newsnews1>";
			
			echo "<td>";
			echo $row['idtransaksi'];
			echo "</td>";
			
			echo "<td>";
			echo $row['kodeproduk'];
			echo "</td>";
			
			echo "<td>";
			echo $row['namaproduk'];
			echo "</td>";
			
			echo "<td>";
			echo $row['namawarehouse'];
			echo "</td>";
			
			echo "<td>";
			if($row['keterangan']==2 || $row['keterangan']==4) {
				echo "<span class='glyphicon glyphicon-arrow-down' style='color:red;'></span> ".$row['qty'];
			} elseif ($row['keterangan']==1 || $row['keterangan']==3) {
				echo "<span class='glyphicon glyphicon-arrow-up' style='color:green;'></span> ".$row['qty'];
			} else { echo "<span class='glyphicon glyphicon-arrow-left'></span> ".$row['qty']; }
			echo "</td>";
			
			echo "<td class='delete'>";
			echo $row['sisastok'];
			echo "</td>";
			
			echo "<td>";
			/*if($row['customer']!=0 || $row['customer']!="") {
				echo $row['customer'];
			} else if ($row['keterangan']==3) {
				echo "Stok Masuk, Supplier ".$row['customer'];
			} else { echo "No input client"; } */
			if(($row['keterangan']==2 || $row['keterangan']==1 || $row['keterangan']==4 || $row['keterangan']==0) && $row['customer']!="" && $row['customer']!="- List Customer -") {
			    if($row['keterangan']==2) {
				    echo $row['customer']." (Customer)";
			    }else { echo $row['customer']; }
			} else if ($row['keterangan']==3 AND $row['customer']!="") {
				echo "<i style='color:red;'>Stok Baru!</i><br>".$row['customer']." (Supplier)";
			} else if ($row['customer']=="" || $row['customer']=="- List Customer -") { 
				echo "No input client"; 
			} 
			echo "</td>";
			
			echo "<td>";
			echo $row['usertransaksi'];
			echo "</td>";
			
			echo "<td>";
			echo $row['tanggaltransaksi'];
			echo "</td>";

			echo "<td>";
			$kodebar = $row['kodeproduk'];
			$namabar = $row['namaproduk'];
			$deskripsi = $row['deskripsi'];
			$test2 = str_replace('"', 'inch', $namabar);
			echo '<button type="submit" class="btn btn-primary btn-s" onclick="liatdeskripsi(\''.$kodebar.'\',\''.$test2.'\',\''.$deskripsi.'\')"><span class="glyphicon glyphicon-eye-open"></span></button></form>';
			echo "</td>";
						
			echo "<td class='delete' id='delete3'>";
			echo "<a href='deletetransaksi.php?id=" . $row['idtransaksi'] ."'>";
			echo "<button type='button' class='btn btn-danger btn-s' onclick='update(".$row['qty'].",".$row['keterangan'].",".$row['iddetailbarang'].",".$row['idtransaksi'].")'><span class='glyphicon glyphicon-trash'></span></button>";
			//
			echo "</td>";
			
			echo "<td class='delete' id='delete3'>";
			if($row['keterangan']!=1 AND $row['keterangan']!=3 AND $row['keterangan']!=4) {
				echo "<form action='edittransaksi.php' method='post'>";
				echo "<input type='hidden' name='id' value=".$row['idtransaksi']." ><button type='submit' class='btn btn-success btn-s'><span class='glyphicon glyphicon-pencil'></span></button></form>";
			}else { echo "<i>Please update dari menu stok!</i>"; }
			echo "</td>";
			echo "</tr>";
			
		}
		echo "</table>";	
	}
			
	?>
	</div>
	<?php  
			/*$sql = "SELECT COUNT(idtransaksi) FROM transaksi";  
			$rs_result = mysqli_query($con, $sql);  
			$row = mysqli_fetch_row($rs_result);  
			$total_records = $row[0];  */
			$result = mysqli_query($con,"select * from transaksi,detailbarang,produk,warehouse where transaksi.iddetailbarang=detailbarang.iddetailbarang AND detailbarang.idproduk=produk.idproduk AND detailbarang.idwarehouse=warehouse.idwarehouse ORDER BY transaksi.idtransaksi DESC");
			$total_records = mysqli_num_rows($result);
			//echo "Limit= ".$limit;
			$total_pages = ceil($total_records / $limit);  
			//echo "Total pages= ".$total_pages;
			$pagLink = "<nav><ul class='pagination'>";  
			for ($i=1; $i<=$total_pages; $i++) {  
				$pagLink .= "<li><a href='admintransaksi.php?page=".$i."'>".$i."</a></li>";  
			};  
			echo $pagLink . "</ul></nav>";  
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