<?php
// Pastikan session sudah dimulai sebelum mengakses variabel session
session_start();

// Periksa apakah ada sesi 'username' yang tersimpan
if (!isset($_SESSION['username'])) {
    // Redirect atau tindakan lain jika tidak ada sesi 'username'
    header('Location: ../login.php'); // Ganti login.php dengan halaman login Anda
    exit();
}

$id_product = $_GET['id'];

// Periksa apakah ada parameter 'id' yang dikirim melalui GET
if (!isset($_GET['id'])) {
    // Tidak ada ID yang diberikan, redirect atau tindakan lain sesuai kebutuhan
    return $id_product; // Ganti halaman_yang_sesuai.php dengan halaman yang sesuai
    
}

// Mengambil ID yang akan dihapus
 // Pastikan untuk mengamankan nilai ID ini untuk mencegah SQL injection

// Koneksi ke database (gunakan cara koneksi yang telah Anda tentukan)
include "../koneksi.php";

// Lakukan penghapusan data dari tabel menggunakan perintah SQL DELETE
$sql_delete = mysqli_query($koneksi, "DELETE FROM products WHERE id_product = '$id_product'");
$sql_delete_harga = mysqli_query($koneksi, "DELETE FROM harga WHERE id_product = '$id_product'");
$sql_delete_kategori = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_product = '$id_product'");
$sql_delete_nama_product = mysqli_query($koneksi, "DELETE FROM nama_product WHERE id_product = '$id_product'");
$sql_delete_image = mysqli_query($koneksi, "DELETE FROM image_url WHERE id_product = '$id_product'");


if ($sql_delete && $sql_delete_harga && $sql_delete_kategori && $sql_delete_nama_product && $sql_delete_image) {
    // Berhasil menghapus data
    echo "Data berhasil dihapus.";
    // Lakukan tindakan atau redirect ke halaman tertentu jika diperlukan
    header('Location: tabel_catalog.php');
} else {
    // Gagal menghapus data
    echo "Gagal menghapus data.";
    // Handle kesalahan atau tampilkan pesan kesalahan jika perlu
}
?>
