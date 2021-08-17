<?php 
/*
* iTech Empires:  Export Data from MySQL to CSV Script
* Version: 1.0.0
* Page: Export
*/
 
// Database Connection
require("php/config.php");
 
// get Users
//$query = "select transaksi.idtransaksi, produk.kodeproduk, produk.namaproduk, warehouse.namawarehouse, transaksi.qty,  transaksi.keterangan, transaksi.sisastok, transaksi.customer, transaksi.usertransaksi, transaksi.tanggaltransaksi from transaksi,detailbarang,produk,warehouse where transaksi.iddetailbarang=detailbarang.iddetailbarang AND detailbarang.idproduk=produk.idproduk AND detailbarang.idwarehouse=warehouse.idwarehouse";
$query = "select transaksi.idtransaksi, produk.kodeproduk, produk.namaproduk, warehouse.namawarehouse, CONCAT(CASE WHEN transaksi.keterangan=2 OR transaksi.keterangan=4 THEN 'OUT' WHEN transaksi.keterangan=3 OR transaksi.keterangan=1 THEN 'IN' ELSE 'SAME' END,''), transaksi.qty, transaksi.sisastok, CONCAT(transaksi.customer, CASE WHEN transaksi.customer='' or transaksi.customer='- List Customer -' THEN '(No Client)' WHEN transaksi.keterangan=2 then ' (Customer)' WHEN transaksi.keterangan=3 then ' (Supplier) Stok Baru!!' WHEN transaksi.keterangan=4 then '' WHEN transaksi.keterangan=1 THEN '' ELSE '' END), transaksi.usertransaksi, transaksi.tanggaltransaksi from transaksi,detailbarang,produk,warehouse where transaksi.iddetailbarang=detailbarang.iddetailbarang AND detailbarang.idproduk=produk.idproduk AND detailbarang.idwarehouse=warehouse.idwarehouse ORDER BY transaksi.idtransaksi DESC";
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
header('Content-Disposition: attachment; filename=DataTransaksi_DianaGlass_'.$tanggal.'.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('ID Transaksi', 'Kode Barang', 'Nama Barang', 'Warehouse','Status', 'Qty (pcs)', 'Sisa stok sekarang (pcs)', 'Keterangan', 'User Update', 'Tanggal Transaksi'));
 
if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
?>