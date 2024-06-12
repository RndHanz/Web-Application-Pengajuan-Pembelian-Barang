<?php
session_start();

include('../function/koneksi.php');


$username = $_POST['username'];
$password = md5($_POST['password']);

// melakukan query untuk memeriksa username dan password
$login = mysqli_query($koneksi, "SELECT * FROM db_login WHERE username='$username' AND PASSWORD ='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    if ($data['role'] == "officer") {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = "officer";
        header("location:../page/db_officer.php");

    } else if ($data['role'] == "finance") {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = "finance";
        header("location:../page/db_finance.php");

    } else if ($data['role'] == "manager") {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = "manager";
        header("location:../page/db_manager.php");
        
    } else {
        header("location:../index.php?pesan=gagal");
    }
} else {
    header("location:../index.php?pesan=gagal");
}
