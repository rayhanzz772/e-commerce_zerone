<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum, arahkan ke halaman login atau halaman yang sesuai
    header("Location: ../login.php");
    exit; // Penting untuk keluar dari skrip setelah melakukan redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,500&family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body{
            background-image: url("../images/mobil.jpg");
            background-position: relative;
        }
    </style>
</head>
<body>
<?php

        include '../header.php';

?>
    <!-- header end -->

    

    <section class="section product">
                <div class="container">

                <?php
                include '../config.php';
                $db = new Database();
                ?>
                    <?php
                    $products = $db->tampil_data_product(); // Memanggil fungsi tampil_data_product() untuk mendapatkan data produk

                    if ($products) { // Memeriksa apakah terdapat data produk
                        echo '<ul class="product-list">';
                        foreach ($products as $data) {
                            echo '<li class="product-item" style="color: white;">
                                    <div class="product-card" tabindex="0">
                                        <figure class="card-banner">
                                            <img src="' . $data["image_url"] . '" width="312" height="350" loading="lazy" alt="' . $data["nama_product"] . '" class="image-contain">
                                            <div class="card-badge">New</div>
                                        </figure>
                                        <div class="card-content">
                                            <h3 class="h3 card-title">
                                                <a href="catalog/beli.php?id=' . $data["id_product"] . '">' . $data["nama_product"] . '</a>
                                            </h3>
                                            <data class="card-price" value="' . $data["harga"] . '">Rp. ' . $data["harga"] . '</data>
                                        </div>
                                    </div>
                                </li>';
                        }
                        echo '</ul>';
                    } else {
                        echo "Tidak ada data produk yang tersedia."; // Pesan jika tidak ada data produk
                    }
                    ?>

        

                </div>
                </li>

                </ul>

                </div>
            </section>
    <!-- Home End -->
</body>
</html>