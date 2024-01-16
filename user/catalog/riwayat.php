<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum, arahkan ke halaman login atau halaman yang sesuai
    header("Location: ../../login.php");
    exit; // Penting untuk keluar dari skrip setelah melakukan redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,500&family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body{
            background-image: url("../../images/mobil.jpg");
            background-position: relative;
        }

        .table {
            background-color: white;
        }

        /* Mengatur warna latar belakang strip pada baris ganjil */
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f3f3f3; /* Warna latar belakang strip */
        }

        /* Ganti warna teks pada tabel menjadi hitam */
        .table th,
        .table td {
            color: black;
        }
        



    </style>
</head>
<body>
<?php

        include 'header.php';

?>
    <!-- header end -->
    <div class="container mt-5">
        
    <h2 style = "margin-bottom: 50px; margin-top: 80px" >Riwayat Pembelian</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Dikirim ke</th>
                <th>Nomor Telpon</th>
                <th>jumlah</th>
                <th>Harga</th>
                <th>total</th>
            </tr>
        </thead>
        <?php
                    include '../../config.php';
                   $db = new Database();
           
                    $no = 1;
                    foreach ($db->tampil_data_riwayat() as $x) {
                        
                        ?>
        <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $x['nama_product']; ?></td>  
                <td><?php echo $x['nama_kategori']; ?></td>    
                <td><?php echo $x['alamat']; ?></td>  
                <td><?php echo $x['no']; ?></td>
                <td><?php echo $x['jumlah']; ?></td>     
                <td><?php echo $x['harga']; ?></td> 
                <td><?php echo $x['total']; ?></td>  
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
    <!-- Home End -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>