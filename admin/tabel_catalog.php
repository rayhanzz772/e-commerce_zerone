<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->

        <!-- Sidebar -->
        <?php
        
        include 'sidebar.php';
        
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "topbar.php"?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tabel Pembeli <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertDataModal">
                        Tambah Data
                    </button></h1>
                    

                    <!-- Modal -->
    <div class="modal" id="insertDataModal" tabindex="-1" role="dialog" aria-labelledby="insertDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertDataModalLabel">Tambah Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="simpan_tambah_data.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="id_product">ID Product:</label>
                            <input type="text" class="form-control" id="id_product" name="id_product">
                        </div>
                        <div class="form-group">
                            <label for="nama_product">Nama Product:</label>
                            <input type="text" class="form-control" id="nama_product" name="nama_product">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga:</label>
                            <input type="text" class="form-control" id="harga" name="harga">
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori:</label>
                            <input type="text" class="form-control" id="kategori" name="kategori">
                        </div>
                        <div class="form-group">
                            <label for="image_url">Upload Gambar:</label>
                            <input type="file" class="form-control-file" id="image_url" name="foto_product">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>


                                        <tr>
                                            <th>#</th>
                                            <th>id_product</th>
                                            <th>nama_product</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>images</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>id_product</th>
                                            <th>nama_product</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>images</th>
                                            <th>Action</th>
                    
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                    include '../config.php';
                   $db = new Database();
                   $no = 0;
                    
                    foreach ($db->tampil_data_product() as $x) {
                        $no++;
                        ?>
        <tr>
                <td><?php echo $no ?></td>  
                <td><?php echo $x['id_product']; ?></td> 
                <td><?php echo $x['nama_product']; ?></td> 
                <td><?php echo $x['nama_kategori']; ?></td>       
                <td><?php echo $x['harga']; ?></td>
                <td><img src="<?php echo $x['image_url']; ?>" alt="Product Image" width="100" height="100"></td>
                <td>        
                                            <!-- membuat tombol dengan ukuran small berwarna biru  -->
                                            <!-- data-target setiap modal harus berbeda, karena akan menampilkan data yang berbeda pula
                                            caranya membedakannya, gunakan id sebagai pembeda data-target di setiap modal -->
                                            <a href="" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#modal<?php echo $x['id_product']; ?>">Edit</a> | 
                                            
                                                <a class="btn btn-sm btn-danger" href='hapus_data_product.php?id=<?php echo $x["id_product"]; ?>'
                                                 onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                                                                    
                                                


                                                        
                                            <!-- untuk melihat bentuk-bentuk modal kalian bisa mengunjungi laman bootstrap dan cari modal di kotak pencariannya -->
                                            <!-- id setiap modal juga harus berbeda, cara membedakannya dengan menggunakan id -->
                                            <div class="modal fade" id="modal<?php echo $x['id_product']; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!-- di dalam modal-body terdapat 4 form input yang berisi data.
                                                        data-data tersebut ditampilkan sama seperti menampilkan data pada tabel. -->
                                                        <div class="modal-body">
                                                            <form action="simpan_edit_data.php" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="id" value="<?php echo $x['id']; ?>"/>
                                                                <div class="form-group">
                                                                    <input type="hidden" name="old_id_product" value="<?php echo $x['id_product']; ?>" class="form-control>

                                                                    <label for="exampleFormControlInput1">id product</label>
                                                                    <input type="text" name="new_id_product" class="form-control"
                                                                        value="<?php echo $x['id_product']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Nama Product</label>
                                                                    <input type="text" name="nama_product" class="form-control"
                                                                        value="<?php echo $x['nama_product']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Kategori</label>
                                                                    <input type="text" class="form-control" name="nama_kategori"
                                                                        value="<?php echo $x['nama_kategori']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Harga</label>
                                                                    <input type="text" class="form-control" name="harga"
                                                                        value="<?php echo $x['harga']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleFormControlFile1">Pilih Foto</label>
                                                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="foto_product">
                                                                </div>

                                                                <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
  
                
        </tr>


        <?php } ?>                                    
    </tbody>

                                    
                                </table>


                                



                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
  document.addEventListener("DOMContentLoaded", function() {
    // Fungsi untuk menampilkan modal saat halaman dimuat
    $('#myModal').modal('show');
  });
</script>

</body>


</html>