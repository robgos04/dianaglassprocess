<?php 
/*
* iTech Empires:  Export Data from MySQL to CSV Script
* Version: 1.0.0
* Page: Export
*/
 
// Database Connection
require("php/config.php");
 
// get Users
$query = "SELECT detailbarang.iddetailbarang, produk.kodeproduk, produk.namaproduk, detailbarang.stok, warehouse.namawarehouse, detailbarang.userstok, detailbarang.tanggalupdate FROM `detailbarang`,`produk`,`warehouse` WHERE detailbarang.idwarehouse=warehouse.idwarehouse AND detailbarang.idproduk=produk.idproduk ORDER BY produk.namaproduk ASC";
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}
 
$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

$date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
$tanggal = $date->format('Ymd');  
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=DataStokBarang_DianaGlass_'.$tanggal.'.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('ID Detail', 'Kode Barang', 'Nama Barang', 'Jumlah Stok (pcs)', 'Lokasi Gudang', 'User Update Stok', 'Tanggal Update'));
 
if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
?>