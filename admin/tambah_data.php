<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
</head>
<body>
    <h2>Insert Data Produk</h2>
    <form action="simpan_tambah_data.php" method="POST" enctype="multipart/form-data"> <!-- Ganti 'process.php' dengan nama file yang akan menangani proses penyimpanan data -->
        <label for="id_product">ID Product:</label>
        <input type="text" id="id_product" name="id_product"><br><br>

        <label for="nama_product">Nama Product:</label>
        <input type="text" id="nama_product" name="nama_product"><br><br>

        <label for="harga">Harga:</label>
        <input type="text" id="harga" name="harga"><br><br>

        <label for="image_url">Upload Gambar:</label>
        <input type="file" id="image_url" name="foto_product"><br><br>

        <label for="kategori">Kategori:</label>
        <input type="text" id="kategori" name="kategori"><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
