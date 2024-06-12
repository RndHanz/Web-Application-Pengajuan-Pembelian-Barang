<?php
$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "pengajuan_pembelian_barang";

// membuat koneksi
$koneksi = mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_error($koneksi));

?>
