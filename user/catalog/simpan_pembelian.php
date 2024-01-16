<?php

include '../../config.php';
$db = new database();
session_start(); // Pastikan session sudah dimulai sebelum mengakses variabel session

// Mengambil nilai dari variabel session 'username'
$koneksi = new Database();
$koneksi->tambah_pembelian($_POST['id_product'],$_POST['username'], $_POST['jenis_kelamin'], $_POST['alamat'], $_POST['no'],$_POST['harga'],$_POST['jumlah'],$_POST['total'],$_POST['keterangan'], $_POST['tgl']);
header('location:../catalog.php');

?>