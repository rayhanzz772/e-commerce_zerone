<?php
    session_start(); // Pastikan session sudah dimulai sebelum mengakses variabel session
    $id = $_GET['id']; // Isi dengan nilai id_product yang benar
    $username = $_SESSION['username']; // Ambil username dari session
    $date = date("Y-m-d");

    include '../../koneksi.php'; // Sesuaikan dengan file koneksi Anda


    $sql = mysqli_query($koneksi, "SELECT * FROM harga
    WHERE harga.id_product = '$id'");

    $tampil = mysqli_fetch_array($sql);

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Bootstrap</title>
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <style>
        /* Mengubah warna label menjadi putih */
        .label-white {
            color: black;
        }

        .form-container {
            margin-top: 100px; /* Sesuaikan nilai margin sesuai kebutuhan */
            max-width: 500px;
            background-color: white;
            margin-top: 100px; 
            padding: 40px;
            border-radius: 15px; 
        }

        h2{
            color: black;
        }

        body{
            background-image: url("../../images/mobil.jpg");
        }
    </style>

</head>
<body>
<?php

        include 'header.php';

?>


    <div class="container form-container">
        <h2>Form Pembelian</h2>
        <form action="simpan_pembelian.php" method="POST">
        <div class="form-group">
                <label for="alamat" class="label-white">Alamat:</label>
                <input type="alamat" name="alamat" class="form-control" id="alamat" placeholder="Enter Address">
            </div>
            <input type="hidden" name="id_product" value="<?php echo $id; ?>" id="">
            <input type="hidden" name="tgl" value="<?php echo $date; ?>" id="">
            <input type="hidden" name="username" value="<?php echo $username; ?>" id="">

            <div class="form-group">
                <label for="No" class="label-white">No telepon:</label>
                <input type="No" name="no" class="form-control" id="No" placeholder="Enter No">
            </div>

            <input type="hidden" value="<?php echo $tampil['harga']; ?>" name="harga">


            <div class="form-group">
            <label for="No" class="label-white">Jenis Kelamin</label><br>
            <select name="jenis_kelamin">
                        <option value="--"></option>
                        <?php
                        include '../../config.php';
                        $db = new database();
                        foreach ($db->tampil_data_jenis_kelamin() as $x) {
                            echo '<option value="' . $x['kode_jk'] . '">' . $x['keterangan_jk'] . '</option>';
                        }
                        ?>
                    </select>
            </div>

            <div class="form-group">
            <label for="jumlah">Jumlah:</label>
                <select name="jumlah">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Keterangan" class="label-white">Keterangan:</label>
                <input type="Keterangan" name="keterangan" class="form-control" id="Keterangan" placeholder="Enter Keterangan">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>