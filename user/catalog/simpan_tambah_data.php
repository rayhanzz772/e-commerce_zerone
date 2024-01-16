
<?php
include('../../config.php'); // Menyertakan file config.php yang berisi pengaturan database dan kelas database

$koneksi = new database(); // Inisialisasi objek koneksi ke database dari kelas database

$cekdir = is_dir("foto_product");
if ($cekdir) {
    opendir("foto_product");
} else {
    mkdir("foto_product");
    chmod("foto_product", 0755);
    opendir("foto_product");
}

$daftar_list = array("jpeg", "jpg", "png");
$nama_file = $_FILES['foto_product']['name'];
$pecah = explode(".", $nama_file);
$ekstensi = $pecah[1]; // Mengambil ekstensi file yang diunggah

if (in_array($ekstensi, $daftar_list)) {
    $lokasi_foto_product = $_FILES['foto_product']['tmp_name'];
    $nama_foto_product = $_FILES['foto_product']['name'];
    $dir_foto_product = "foto_product/" . $nama_foto_product;
    move_uploaded_file($lokasi_foto_product, $dir_foto_product);

    // Memanggil fungsi tambah_data_product dari objek koneksi database
    $koneksi->tambah_data_product(
        $_POST['id_product'],
        $_POST['nama_product'],
        $_POST['harga'],
        $_POST['kategori'],
        $dir_foto_product
    );

    header('location: tabel_catalog.php'); // Redirect ke halaman tabel_catalog.php setelah berhasil
} else {
    echo "Tipe file harus berupa gambar <br>";
    header('location: tabel_catalog.php'); // Redirect ke halaman tampilkan_data_product.php jika tipe file tidak sesuai
}
?>
