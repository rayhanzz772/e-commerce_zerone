<?php

class Database {
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "zeroone";
    var $koneksi = "";

    function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }


    function tampil_data_product() {
        $data = mysqli_query($this->koneksi, "SELECT *
        FROM 
            products p
        INNER JOIN 
            nama_product np ON p.id_product = np.id_product
        INNER JOIN 
            image_url iu ON p.id_product = iu.id_product
        INNER JOIN 
            harga h ON p.id_product = h.id_product
        INNER JOIN 
            kategori k ON p.id_product = k.id_product");
    
        // Periksa apakah query berhasil atau tidak
        if (!$data) {
            // Jika terdapat error, tampilkan pesan error
            die("Error: " . mysqli_error($this->koneksi));
        }
    
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tambah_user($user, $email, $password)
    {
        // Gunakan prepared statement untuk menghindari serangan SQL injection
        $stmt = $this->koneksi->prepare("INSERT INTO user (username, email, akses_id, password) VALUES (?, ?, ?, ?)");
        
        // Penanganan error saat penyiapan query
        if (!$stmt) {
            die("Error pada prepare statement: " . $this->koneksi->error);
        }
        
        $akses_id = 2; // Nilai tetap untuk akses_id
        
        // Bind parameter ke query
        $stmt->bind_param("ssis", $user, $email, $akses_id, $password); // Sesuaikan dengan jumlah placeholder dan tipe data
        
        // Eksekusi query
        $stmt->execute();
        $stmt->close();
    }
    
    

    public function tambah_data_product($id_product, $nama_product, $harga, $kategori, $dir_foto_product) {
        $query_products = "INSERT INTO products (id_product) VALUES ('$id_product')";
        $query_nama_product = "INSERT INTO nama_product (id_product, nama_product) VALUES ('$id_product', '$nama_product')";
        $query_harga = "INSERT INTO harga (id_product, harga) VALUES ('$id_product', '$harga')";
        $query_image_url = "INSERT INTO image_url (id_product, image_url) VALUES ('$id_product', '$dir_foto_product')";
        $query_kategori = "INSERT INTO kategori (id_product, nama_kategori) VALUES ('$id_product', '$kategori')";

        $result_products = mysqli_query($this->koneksi, $query_products);
        $result_nama_product = mysqli_query($this->koneksi, $query_nama_product);
        $result_harga = mysqli_query($this->koneksi, $query_harga);
        $result_image_url = mysqli_query($this->koneksi, $query_image_url);
        $result_kategori = mysqli_query($this->koneksi, $query_kategori);

        if ($result_products && $result_nama_product && $result_harga && $result_image_url && $result_kategori) {
            echo "Data berhasil disimpan.";
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
        }
    }

    public function update_data_product($old_id_product, $new_id_product, $nama_product, $harga, $kategori, $dir_foto_product) {
        $query_update_products = "UPDATE products SET id_product = '$new_id_product' WHERE id_product = '$old_id_product'";
        $query_update_nama_product = "UPDATE nama_product SET id_product = '$new_id_product', nama_product = '$nama_product' WHERE id_product = '$old_id_product'";
        $query_update_harga = "UPDATE harga SET id_product = '$new_id_product', harga = '$harga' WHERE id_product = '$old_id_product'";
        $query_update_image_url = "UPDATE image_url SET id_product = '$new_id_product', image_url = '$dir_foto_product' WHERE id_product = '$old_id_product'";
        $query_update_kategori = "UPDATE kategori SET id_product = '$new_id_product', nama_kategori = '$kategori' WHERE id_product = '$old_id_product'";
    
        $result_update_products = mysqli_query($this->koneksi, $query_update_products);
        $result_update_nama_product = mysqli_query($this->koneksi, $query_update_nama_product);
        $result_update_harga = mysqli_query($this->koneksi, $query_update_harga);
        $result_update_image_url = mysqli_query($this->koneksi, $query_update_image_url);
        $result_update_kategori = mysqli_query($this->koneksi, $query_update_kategori);
    
        if ($result_update_products && $result_update_nama_product && $result_update_harga && $result_update_image_url && $result_update_kategori) {
            echo "Data berhasil diperbarui.";
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
        }
    }
    
    

    function login($username)
    {
    $data = mysqli_query($this->koneksi, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($data) == 0) {
        echo "<b>Data user tidak ditemukan</b>";
        $hasil = [];
        header('location: login.php');
    } else {
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
    }

    return $hasil;
    }


    function tampil_data_jenis_kelamin() {
        $data = mysqli_query($this->koneksi, "SELECT * FROM jenis_kelamin");
        $hasil = array();
    
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $hasil[] = $row;
            }
        } else {
            echo "Query failed: " . mysqli_error($this->koneksi);
        }
    
        return $hasil;
    }


    function tambah_pembelian($username, $id_product, $jenis_kelamin, $alamat, $no, $harga, $jumlah, $total ,$keterangan, $tgl)
    {
        $total = $jumlah * $harga;
        $query_products = "INSERT INTO pembeli VALUES ('','$username','$id_product','$jenis_kelamin','$alamat','$no', $harga,'$jumlah','$total','$keterangan', '$tgl')";
        $result_products = mysqli_query($this->koneksi, $query_products);

        if($result_products){
            echo "Data berhasil disimpan.";
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
        }
    }
    
    function tampil_data_riwayat() {
        $data = mysqli_query($this->koneksi, "SELECT *
                                              FROM pembeli p
                                              INNER JOIN harga h ON p.id_product = h.id_product
                                              INNER JOIN nama_product np ON p.id_product = np.id_product
                                              INNER JOIN kategori k ON p.id_product = k.id_product
                                              INNER JOIN jenis_kelamin jk ON p.jenis_kelamin = jk.kode_jk
                                                ");
    
        // Periksa apakah query berhasil atau tidak
        if (!$data) {
            // Jika terdapat error, tampilkan pesan error
            die("Error: " . mysqli_error($this->koneksi));
        }
    
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tampil_data_user() {
        $data = mysqli_query($this->koneksi, "SELECT *
                                              FROM user 
                                                ");
    
        // Periksa apakah query berhasil atau tidak
        if (!$data) {
            // Jika terdapat error, tampilkan pesan error
            die("Error: " . mysqli_error($this->koneksi));
        }
    
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }






}



?>