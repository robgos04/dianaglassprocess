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
$date->format('Y-m-d H:i:s');
//echo "Waktu di Makassar: ".$date;

?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	$("#sisa").html(angka+" pcs");
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

$(document).ready(function(){
    
    $(window).on('load', function() {
			$("body").fadeIn(500);
	     });
		 
	var path = window.location.pathname.split("/");
	//console.log(path.length);
	var strippedPath = path.slice(path.length-1, path.length).join("/");
	
	var path1 = "/"+strippedPath;

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
		 $(".delete").hide();
		 
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
		 $("#daftar").hide();
		 $(".deletesales").hide();
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
		 //$("#daftar").hide();
		 //$(".delete1").hide();
		 $(".delete").hide();
		 
		 if(path1 != "/admintransaksi.php" && path1 != "/adminstok.php" && path1 != "/admincustomer.php"){
		     location.href = "admintransaksi.php";
		 }
		 
	} else if ("statusinventoryoffice" in localStorage) {
		 //alert("inventory");
		 var pemakai = window.localStorage.getItem("statusinventoryoffice");
		 //alert(pemakai);
		 document.getElementById("menu").children[2].style.display="none";
		 document.getElementById("menu").children[3].style.display="none";
		 document.getElementById("menu").children[4].style.display="none";
		 document.getElementById("menu").children[6].style.display="none";
		 $(".delete").hide();
		 
		 if(path1 != "/admintransaksi.php" && path1 != "/adminstok.php" && path1 != "/admincustomer.php"){
		     location.href = "admintransaksi.php";
		 }
	 
	}else{
	    location.href="index.php";
	}
	
	$("#userstok").val(pemakai);
	$("#userstok1").val(pemakai);

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
	
	document.getElementById('ketUpdate').style.display = 'none';
  
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
				$("#kode1").append('<option value="'+item.idproduk+'|'+item.kodeproduk+'|'+item.namaproduk+'">'+item.kodeproduk+' - '+item.namaproduk+'</option>');
				
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
		//document.getElementById('idbarang').value = event.target.value  
		//$("#kodebarang").val($("option:selected', #kode1").attr("data-kode"));
		//$("#namabarang").val($("option:selected', #kode1").attr("data-nama"));
		getValuemember(event.target.value);
		cekStok();	
	}
	$("#kode1").trigger("onchange");
	
	document.getElementById('gudang1').onchange = function () { // <-- Untuk pilih gudang
		document.getElementById('gudang').value = event.target.value 
		cekStok();
	}
	$("#gudang1").trigger("onchange");

	function cekStok() {
		var a = $("#idbarang").val();
		var b = $("#gudang1").val();
		
		dt={idproduk1:a,idwarehouse1:b};
		$.ajax({
			type: "POST",
			url: host+'/php/viewdatadetailbarang.php',
			data: dt,
			dataType: 'json',
			success:function (data, status) {
				
				var x = null;
				if(data[0].stok == null || data[0].stok < 0){
					x = 0;
					$("#stok").html("<b style='color:red;'>Belum ada Stok!!</b>");
					$("#ketUpdate").css("display","none");
					$("#warning").html("");
					$("#status").val("Off");
				}else{
					x = data[0].stok;
					$("#stok").html("Sisa Stok: <b style='color:red'>" +x+"</b> pcs");
					$("#ketUpdate").css("display","block");
					$("#warning").html("<b style='color:red;'> Sudah ada Data Stok!! Tidak perlu input data baru!</b>");
					$("#status").val("On");
				}
				
				$("#stok2").val(x);
				
			},
			error: function(){
				//alert("error barang");
			}
		});
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
			 
			 var str="<table class='table table-responsive table-bordered' id='userTbl1'><thead><tr class='newsnews1'><th><strong>Jumlah Stok (pcs)</strong></th><th><strong>Lokasi gudang</strong></th><th class='deletesales'><strong>User</strong></th><th class='deletesales'><strong>Tanggal Update</strong></th><th class='testing'><strong>Delete</strong></th><th class='testing'><strong>Edit All</strong></th></tr></thead>";

			for(i=0;i<n;i++)
			{ 
				str = str + "<tr class=newsnews1><td>"+ data[i].stok + "<br><button type='submit' class='btn btn-info btn-s deletesales deleteinventory' onclick='klikstok("+data[i].stok+","+data[i].iddetailbarang+")'><span class='glyphicon glyphicon-pencil'></span></button></form></td><td>"+ data[i].namawarehouse + "</td><td class='deletesales'>"+ data[i].userstok + "</td><td class='deletesales'>"+ data[i].tanggalupdate + "</td><td class='testing'><a href='deletedetail.php?id="+data[i].iddetailbarang+"'><button type='button' class='btn btn-danger btn-s'><span class='glyphicon glyphicon-trash'></span></button></td><td class='testing'><form action='editdetail.php' method='post'><input type='hidden' name='id' value="+data[i].iddetailbarang+" ><button type='submit' class='btn btn-success btn-s'><span class='glyphicon glyphicon-pencil'></span></button></form></td></tr>"
				
			}
			str = str + "</table>" ;
			document.getElementById("display").innerHTML=str;
			
			// Memanggil fungsi untuk hide
			if("statussupervisor" in localStorage) {
				testing_hide('testing');
		 	} else if("statussales" in localStorage) {
				testing_hide('testing');
				testing_hide('deletesales');
		 	} else if ("statusinventory" in localStorage) {
		 	    testing_hide('testing');
				testing_hide('deleteinventory');
		 	} else if ("statusinventoryoffice" in localStorage) {
		 	    testing_hide('testing');
				testing_hide('deleteinventory');
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
				
					<label style="font-style: italic;">List Barang ?</label>
					<input type="hidden" placeholder="Warehouse" id="idbarang" name="idbarang" class="form-control">
					<select name="kode1" id="kode1" class="form-control">
						   <option selected>- Pilih Barang -</option>
					</select>
					
					<!-- <i style="color:black;">Kode & Nama Barang</i><br> -->
					<input name="kodeproduk" type="hidden" placeholder="ID Barang" class="form-control" id="kodebarang">
					<input name="namaproduk" type="hidden" placeholder="Nama Barang" class="form-control" id="namabarang">
					<br>
					<label style="font-style: italic;">Simpan di gudang ?</label>
					
					<input type="hidden" placeholder="Warehouse" id="gudang" name="gudang" class="form-control">
					<select name="gudang1" id="gudang1" class="form-control">
					   <option selected>- Pilih Gudang -</option>
					</select>
					<br>
					<label style="font-style: italic;"><div id="stok"></div></label>
					<input name="stok2" type="hidden" placeholder="Jumlah stok" class="form-control" id="stok2">
					<br><br>
					<label style="font-style: italic;">Supplier Asal ?</label>
					
					<input type="hidden" placeholder="Supplier" id="idsupplier" name="idsupplier" class="form-control">
					<select name="supplier1" id="supplier1" class="form-control">
					   <option selected>- Pilih Supplier -</option>
					</select>
					<br>
					<label style="font-style: italic;">Qty (In<span class='glyphicon glyphicon-arrow-up' style='color:green;'></span>)</label>
					<input name="stoktambah" type="number" placeholder="Qty masuk" class="form-control" id="stoktambah" autocomplete="off">
					<input name="status" type="hidden" placeholder="Status" class="form-control" id="status">
					
					<input name="userstok" type="hidden" placeholder="user stok" class="form-control" id="userstok">
					
					<div id="ketUpdate">
					<br>
					<label style="font-style: italic;">Keterangan update:</label><br>
					<input name="ket2" type="text" placeholder="Keterangan" class="form-control" id="ket2">
					</div>
					<br>
						<button type="submit" class="btn btn-primary">Input</button>
					
			</form>
		</div>
		
		<div id='dialogstok' title='Update jumlah stok'>
		<form action='updatestok.php' method='POST' class='form-horizontal' enctype='multipart/form-data' role='form'>
		
			<label style="font-style: italic;">Jumlah Stok sekarang: <div id="sisa" style="color:red;"></div></label>
			<br>
			<label style="font-style: italic;">Update Stok</label><br>
			<input type="hidden" name="iddetailbarang1" id="iddetailbarang1">
			<input type="hidden" name="userstok1" id="userstok1">
			<input name="stok1" type="number" placeholder="Stok" class="form-control" id="stok1">
			<br>
			<label style="font-style: italic;">Keterangan</label><br>
			<input name="ket1" type="text" placeholder="Keterangan" class="form-control" id="ket1">
			<br><button type='submit' class='btn btn-primary'>Update</button>
			
		</form>
		</div>
		
		<div id='dialogket' title='Detail Barang'>
			<div id="code"></div><br>
			<div id="name"></div><br>
			<div id="desc"></div><br>
			<!--<div id="price"></div>-->
		</div>
		
		<div id="dialogket1" title='Rincian Stok (Jumlah & Posisi Stok di Lokasi Gudang)'>
			<div id="kode2"></div>
			<div id="nama1"></div>
			<br>
			<div class="form-group pull-left">
				<input type="text" class="search1 form-control" placeholder="Search">
			</div>
		
			<div id="display"></div>
			
			
		</div>
	
	<div class="form-group pull-right delete">
	<button onclick="Export()" class="btn btn-success">Export to CSV File</button> 
	</div>
	
	<script>
        function Export()
        {
            var conf = confirm("Export Data Stok Barang to CSV?");
            if(conf == true)
            {
                window.open("exportstok.php", '_blank');
            }
        }
	</script>
	
	<div class="form-group pull-left">
			<input type="text" class="search form-control" placeholder="Search">
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
		
	$result = mysqli_query ($con,"SELECT *,SUM(detailbarang.stok) stokbarangsum, MAX(detailbarang.tanggalupdate) maxdate FROM `detailbarang`,`produk` WHERE detailbarang.idproduk=produk.idproduk GROUP BY produk.idproduk ORDER by produk.namaproduk ASC");
	
	echo	"<table class='table table-responsive table-bordered scroll' id='userTbl'>";
	if (!empty($result))
	{
			echo "<thead>";
				echo "<tr class='newsnews1'>";
			/*	echo "<th>";
				echo "<strong>ID Barang</strong>";
				echo "</th>"; */
				
				echo "<th>";
				echo "<strong>Kode Barang</strong>";
				echo "</th>";
				
				echo "<th class='tabjudul'>";
				echo "<strong>Nama Barang</strong>";
				echo "</th>";
				
				echo "<th>";
				echo "<strong>Keterangan</strong>";
				echo "</th>";

				echo "<th>";
				echo "<strong>Jumlah Stok (pcs)</strong>";
				echo "</th>";
				
				echo "<th class='deletesales'>";
				echo "<strong>Tanggal Update</strong>";
				echo "</th>";			
		
				echo "</tr>";
			echo "</thead>";
		
		while ($row=mysqli_fetch_array($result))
		{
			echo "<tr class=newsnews1>";
			
		/*	echo "<td id='idcari'>";
			echo $row['idproduk'];
			echo "</td>"; */
			
			echo "<td>";
			echo $row['kodeproduk'];
			echo "</td>";
			
			echo "<td>";
			echo $row['namaproduk'];
			$kodebar = $row['kodeproduk'];
			$namabar = $row['namaproduk'];
			$deskripsi = $row['deskripsi'];
			//$test2 = str_replace('"', '&quot;', $namabar);
			$test2 = str_replace('"', 'inch', $namabar);
			//$harga = $row['harga'];
			//echo "<br><button type='submit' class='btn btn-primary btn-s' onclick='liatdeskripsi(\"$kodebar\",\"$namabar\",\"$deskripsi\")'><span class='glyphicon glyphicon-eye-open'></span></button></form>";
			echo '<br><button type="submit" class="btn btn-primary btn-s" onclick="liatdeskripsi(\''.$kodebar.'\',\''.$test2.'\',\''.$deskripsi.'\')"><span class="glyphicon glyphicon-eye-open"></span></button></form>';
			echo "</td>";
			
			echo "<td>";
			echo $row['deskripsi'];
			echo "</td>";

			echo "<td class='tabdesk'>";
			echo $row['stokbarangsum'];
			$nomor = $row['idproduk'];
			echo "<br><button type='submit' class='btn btn-success btn-s' onclick='liatdetail(\"$nomor\",\"$kodebar\",\"$test2\")'><span class='glyphicon glyphicon-th-list'></span></button></form>";
			echo "</td>";
			
			echo "<td class='deletesales'>";
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