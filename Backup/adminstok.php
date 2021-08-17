<?php
include("php/config.php");

function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "gudangceling");
	//$connect = mysqli_connect("localhost","id3442564_robgos04","gudangceling","id3442564_gudangceling");
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
//var host="https://libraryrobertcom.000webhostapp.com";
var host="http://localhost/gudangceling";

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
	$("#dialogket").hide();
	$("#dialogket1").hide();
	$("#dialogstok").hide();
});

$(document).on("click","#create-user",function() {
	$( "#dialog" ).dialog();
} );

function klikstok(angka,idangka) {
	$( '#dialogstok' ).dialog();
	$("#sisa").html(angka+" unit");
	$("#stok1").val(angka);
	$("#iddetailbarang1").val(idangka);
}

function liatdeskripsi(code,name,desc) {
	$( '#dialogket' ).dialog();
	$("#code").html("Kode Barang: "+code);
	$("#name").html("Nama Barang: "+name);
	$("#desc").html("Deskripsi: "+desc);
	//$("#price").html("Harga: "+price);
}

var arrID=new Array();
var first=true;

function CloseFunction () {
    	document.getElementById("display").innerHTML="";
}


 

function getValuemember(val) {
		var myval=val.split('|');
        document.getElementById('idbarang').value=myval[0];
        document.getElementById('kodebarang').value=myval[1];
		document.getElementById('namabarang').value=myval[2];
		//$('#jml').html("<b style='color:black;'>Sisa stok: "+myval[3]+" pcs</b>");
}

$(function() {
		
});

$(document).ready(function(){
	
	//Fungsi Auto Complete Suggestion
	$(".skill_input").autocomplete({
			source: "suggestion.php",
			//source: [ "PHP", "Python", "Ruby", "JavaScript", "MySQL", "Oracle" ],
			select: function( event, ui ) {
				event.preventDefault();
				$(".skill_input").val(ui.item.value);
			}
	});

	if("statuslogin" in localStorage){
		var pemakai = window.localStorage.getItem("statuslogin");
		//alert(pemakai);
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
		 //$(".delete1").hide();
		 
	}

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
	
	//Fungsi Search detail stok
    $('.search1').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        $('#userTbl1 tbody tr').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    });
	
	document.getElementById('gudang1').onchange = function () { // <-- Untuk pilih gudang
		document.getElementById('gudang').value = event.target.value 
			
		var a = document.getElementById('idbarang').value;
		var b = document.getElementById("gudang").value;
		var c = document.getElementById("idsupplier").value;
		//alert(a);alert(b);
		dt={idproduk1:a,idwarehouse1:b,idsupplier1:c};
		$.ajax({
			type: "POST",
			url: host+'/php/viewdatadetailbarangwithsupplier.php',
			data: dt,
			dataType: 'json',
			success:function (data, status) {
				
				jsonResult = data;
				userlogin=jsonResult[0];

				if(userlogin.idproduk && userlogin.idwarehouse && userlogin.idsupplier) {
					var x = ""+userlogin.stok;
					//alert(x);
					//document.getElementById("jml").innerHTML = "Sisa Stok: " +x+" pcs";
					//$("#iddetail").val(userlogin.iddetailbarang);
					$("#stok").val(x);
					document.getElementById("warning").innerHTML="<b style='color:red;'> Sudah ada Data Stok!!</b>";
				}
			},
			error: function(){
				//alert("error barang");
				//document.getElementById("jml").innerHTML = "Sisa Stok: 0 pcs";
				$("#stok").val(0);
				document.getElementById("warning").innerHTML="";
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
	
	document.getElementById('supplier1').onchange = function () { // <-- Untuk pilih supplier
		document.getElementById('idsupplier').value = event.target.value 
			
		var a = document.getElementById('idbarang').value;
		var b = document.getElementById("gudang").value;
		var c = document.getElementById("idsupplier").value;
		//alert(a);alert(b);
		dt={idproduk1:a,idwarehouse1:b,idsupplier1:c};
		$.ajax({
			type: "POST",
			url: host+'/php/viewdatadetailbarangwithsupplier.php',
			data: dt,
			dataType: 'json',
			success:function (data, status) {
				
				jsonResult = data;
				userlogin=jsonResult[0];

				if(userlogin.idproduk && userlogin.idwarehouse && userlogin.idsupplier) {
					var x = ""+userlogin.stok;
					//alert(x);
					//document.getElementById("jml").innerHTML = "Sisa Stok: " +x+" pcs";
					//$("#iddetail").val(userlogin.iddetailbarang);
					$("#stok").val(x);
					document.getElementById("warning").innerHTML="<b style='color:red;'> Sudah ada Data Stok!!</b>";
				}
			},
			error: function(){
				//alert("error barang");
				//document.getElementById("jml").innerHTML = "Sisa Stok: 0 pcs";
				$("#stok").val(0);
				document.getElementById("warning").innerHTML="";
			}
		});
	}
  
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
	
	//Fungsi Untuk cek Stok barang berdasarkan dari barang
	document.getElementById('kode1').onchange = function () { // <-- Untuk pilih barang
		document.getElementById('idbarang').value = event.target.value  
		/*idproduk=event.target.value; alert(idproduk);*/
			
		var a = document.getElementById('idbarang').value;
		var b = document.getElementById("gudang").value;
		var c = document.getElementById("idsupplier").value;
		//alert(a);alert(b);
		dt={idproduk1:a,idwarehouse1:b,idsupplier1:c};
		$.ajax({
			type: "POST",
			url: host+'/php/viewdatadetailbarangwithsupplier.php',
			data: dt,
			dataType: 'json',
			success:function (data, status) {
				
				jsonResult = data;
				userlogin=jsonResult[0];

				if(userlogin.idproduk && userlogin.idwarehouse && userlogin.idsupplier) {
					var x = ""+userlogin.stok;
					//alert(x);
					//document.getElementById("jml").innerHTML = "Sisa Stok: " +x+" pcs";
					//$("#iddetail").val(userlogin.iddetailbarang);
					$("#stok").val(x);
					document.getElementById("warning").innerHTML="<b style='color:red;'> Sudah ada Data Stok!!</b>";
				}
			},
			error: function(){
				//alert("error barang");
				//document.getElementById("jml").innerHTML = "Sisa Stok: 0 pcs";
				$("#stok").val(0);
				document.getElementById("warning").innerHTML="";
			}
		});
	}
	
	//View list produk
	var id1=getUrlParameter("id");
	
	$.ajax({
		url: host+'/php/viewproduk.php',
		data: { "id": id1},
		dataType: 'json',
		success: function(data, status){
			//alert("success");
			$("#kode1").html("<option selected>- Pilih Barang -</option>");
			$.each(data, function(i,item){ 
				$("#kode1").append('<option value="'+item.idproduk+'">'+item.kodeproduk+' - '+item.namaproduk+'</option>');
				
			});
			 //$('ul').listview('refresh');
		},
		error: function(){
			//alert("error");
			output.text('There was an error loading the data.');
		}
	})
	
	$("#logout").click(function() {
			window.localStorage.removeItem("statuslogin");
			window.localStorage.removeItem("statusinventory");
			window.localStorage.removeItem("statussales");
			window.localStorage.removeItem("statussupervisor");
			window.location="index.php";
	});
	
	$("#pemakai").html("Hello,"+pemakai);
	
});

function liatdetail(angka,kode,nama) {
	$( '#dialogket1' ).dialog({
			width: 700,
			height: 350,
			position: {
                    my: "center",
                    at: "center"
                },
			overflow:"auto",
			close: CloseFunction
	}); 
	
	$("#kode2").html("Kode Produk: "+kode);
	$("#nama1").html("Nama Produk: "+nama);
	
	var a = angka;
	//alert(a);alert(b);
	//alert(a);
	
	dt={idproduk1:a}; 
	$.ajax({
		type: "POST",
		url: host+'/php/viewdetailbarangsetelahklik.php',
		data: dt,
		dataType: 'json',
		success:function (data, status) {

			 var n = data.length;
			 //var str="<table><tr><th>ID</th><th>Name</th><th>Stok</th></tr>";
			 
			 var str="<table class='table table-responsive table-bordered' id='userTbl1'><thead><tr class='newsnews1'><th><strong>ID Detail</strong></th><th><strong>Jumlah Stok (pcs)</strong></th><th><strong>Lokasi gudang</strong></th><th><strong>Supplier</strong></th><th><strong>Tanggal Update</strong></th><th class='testing'><strong>Delete</strong></th><th class='testing'><strong>Edit All</strong></th></tr></thead>";

			for(i=0;i<n;i++)
			{ 
				str = str + "<tr class=newsnews1><td>" + data[i].iddetailbarang + " </td><td>"+ data[i].stok + "<br><button type='submit' class='btn btn-info btn-s deletesales' onclick='klikstok("+data[i].stok+","+data[i].iddetailbarang+")'><span class='glyphicon glyphicon-pencil'></span></button></form></td><td>"+ data[i].namawarehouse + "</td><td>"+ data[i].namasupplier + "</td><td>"+ data[i].tanggalupdate + "</td><td class='testing'><a href='deletedetail.php?id="+data[i].iddetailbarang+"'><button type='button' class='btn btn-danger btn-s'><span class='glyphicon glyphicon-trash'></span></button></td><td class='testing'><form action='editdetail.php' method='post'><input type='hidden' name='id' value="+data[i].iddetailbarang+" ><button type='submit' class='btn btn-success btn-s'><span class='glyphicon glyphicon-pencil'></span></button></form></td></tr>"
				
			}
			str = str + "</table>" ;
			document.getElementById("display").innerHTML=str;
			
			// Memanggil fungsi untuk hide
			if("statussupervisor" in localStorage) {
				testing_hide('testing');
		 	} else if("statussales" in localStorage || "statusinventory" in localStorage) {
				testing_hide('testing');
				testing_hide('deletesales');
		 	}
			
		},
		error: function(){
			//alert("error barang");
			//document.getElementById("jml").innerHTML = "Sisa Stok: 0 pcs";
			//$("#stok").val(0);
			//document.getElementById("warning").innerHTML="";
		}
	}); 
}

// buat fungsi hide
function testing_hide(id) {
	$('.'+id).hide();
}

 </script>
 <style>
 ul.ui-autocomplete {
    z-index: 1100;
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
		
		<h1> Data Stok Barang </h1>
		
		<div id="daftar">
			<button type="button" id="create-user" class="btn btn-primary" >Input Stok Barang</button>
		</div>
		<br>
		
		<div id="dialog" title="Daftar Barang baru">
			<form action="inputdetail.php" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
				<table width="100%">
				<tr>
					<td>
					<i style="color:black;">List Barang ?</i><br>
					<div class="auto-widget">
						<p><input type="text" class="form-control skill_input" placeholder="Nama Produk"/></p>
					</div>
					
					<input type="hidden" placeholder="Warehouse" id="idbarang" name="idbarang" class="form-control">
					<select name="kode1" id="kode1" class="form-control">
						   <option selected>- Pilih Barang -</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>
					<!-- <i style="color:black;">Kode & Nama Barang</i><br> -->
					<input name="kodeproduk" type="hidden" placeholder="ID Barang" class="form-control" id="kodebarang">
					<input name="namaproduk" type="hidden" placeholder="Nama Barang" class="form-control" id="namabarang">
					</td>
				</tr>
				<tr>
					<td><br>
					<i style="color:black;">Berapa Stok Barang ? <div id="warning"></div></i><br>
					<input name="stok" type="number" placeholder="Jumlah stok" class="form-control" id="stok">
					</td>
				</tr>
				<tr>	
					<td><br>
					<i style="color:black;">Simpan di gudang ?</i><br>
					
					<input type="hidden" placeholder="Warehouse" id="gudang" name="gudang" class="form-control">
					<select name="gudang1" id="gudang1" class="form-control">
					   <option selected>- Pilih Gudang -</option>
					</select>
					</td>
				</tr>
				<tr>	
					<td><br>
					<i style="color:black;">Supplier Asal ?</i><br>
					
					<input type="hidden" placeholder="Supplier" id="idsupplier" name="idsupplier" class="form-control">
					<select name="supplier1" id="supplier1" class="form-control">
					   <option selected>- Pilih Supplier -</option>
					</select>
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
			<input type="hidden" name="iddetailbarang1" id="iddetailbarang1">
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
		
		<div id="dialogket1" title='Rincian Stok'>
			<div id="kode2"></div>
			<div id="nama1"></div>
			<br>
			<div class="form-group pull-left">
				<input type="text" class="search1 form-control" placeholder="Search">
			</div>
		
			<div id="display"></div>
			
			
		</div>
		
	<div class="form-group pull-left">
			<input type="text" class="search form-control" placeholder="Search">
	</div>
	
	
	<?php
	
	/* $result = mysqli_query ($con,"SELECT * FROM `detailbarang`,`produk`,`warehouse`,`supplier` WHERE detailbarang.idproduk=produk.idproduk AND detailbarang.idwarehouse=warehouse.idwarehouse AND detailbarang.idsupplier=supplier.idsupplier ORDER by detailbarang.iddetailbarang DESC");
	
	echo	"<table class='table table-responsive table-bordered' id='userTbl'>";
	if (!empty($result))
	{
			echo "<thead>";
				echo "<tr class='newsnews1'>";
				echo "<th>";
				echo "<strong>ID Detail</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Kode Barang</strong>";
				echo "</th>";
				
				echo "<th class='tabjudul'>";
				echo "<strong>Nama Barang</strong>";
				echo "</th>";

				echo "<th>";
				echo "<strong>Jumlah Stok (pcs)</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Lokasi gudang</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Supplier</strong>";
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
			echo "<tr class=newsnews1>";
			
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
			//$harga = $row['harga'];
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
			echo $row['namasupplier'];
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
		echo"</table>"; */
		
	$result = mysqli_query ($con,"SELECT *,SUM(detailbarang.stok) stokbarangsum, MAX(detailbarang.tanggalupdate) maxdate FROM `detailbarang`,`produk` WHERE detailbarang.idproduk=produk.idproduk GROUP BY produk.idproduk ORDER by detailbarang.iddetailbarang DESC");
	
	echo	"<table class='table table-responsive table-bordered' id='userTbl'>";
	if (!empty($result))
	{
			echo "<thead>";
				echo "<tr class='newsnews1'>";
				echo "<th>";
				echo "<strong>ID Barang</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Kode Barang</strong>";
				echo "</th>";
				
				echo "<th class='tabjudul'>";
				echo "<strong>Nama Barang</strong>";
				echo "</th>";

				echo "<th>";
				echo "<strong>Jumlah Stok (pcs)</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Tanggal Update</strong>";
				echo "</th>";			
		
				echo "</tr>";
			echo "</thead>";
		
		while ($row=mysqli_fetch_array($result))
		{
			echo "<tr class=newsnews1>";
			
			echo "<td id='idcari'>";
			echo $row['idproduk'];
			echo "</td>";
			
			echo "<td>";
			echo $row['kodeproduk'];
			echo "</td>";
			
			echo "<td>";
			echo $row['namaproduk'];
			$kodebar = $row['kodeproduk'];
			$namabar = $row['namaproduk'];
			$deskripsi = $row['deskripsi'];
			//$harga = $row['harga'];
			echo "<br><button type='submit' class='btn btn-primary btn-s' onclick='liatdeskripsi(\"$kodebar\",\"$namabar\",\"$deskripsi\")'><span class='glyphicon glyphicon-eye-open'></span></button></form>";
			echo "</td>";

			echo "<td class='tabdesk'>";
			echo $row['stokbarangsum'];
			$nomor = $row['idproduk'];
			echo "<br><button type='submit' class='btn btn-success btn-s' onclick='liatdetail(\"$nomor\",\"$kodebar\",\"$namabar\")'><span class='glyphicon glyphicon-th-list'></span></button></form>";
			echo "</td>";
			
			echo "<td>";
			echo $row['maxdate'];
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