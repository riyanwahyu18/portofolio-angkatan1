<?php
require_once "../koneksi.php";
session_start(); // untuk login menggunakan gmail 

//middleware
if(empty($_SESSION['EMAIL'])){
    header("location:../login.php");
}

// ini bagian menambahkan project
// kalau dari unput pakai POST
// kalau dari url pakai GET
// kalau foto pakai file/files

//insert masukan data
if (isset($_POST['simpan'])){
    $id_kategori = $_POST['id_kategori'];
    $judul = $_POST['judul'];
    $status = $_POST['status'];
    $isi = $_POST['isi'];
    $tags = $_POST['tags'];
    $penulis = $_SESSION['FULLNAME'];
    $foto = $_FILES['foto'];
    

    if ($foto['error'] == 0) {
      $fileName = uniqid() . "_" . basename($foto['name']);
      $filePath = "../assets/uploads/" . $fileName;
      move_uploaded_file($foto['tmp_name'], $filePath);
      
      $insert = mysqli_query ($conn, "INSERT INTO blog (id_kategori, judul, isi, status, tags, penulis, foto) VALUES ('$id_kategori', '$judul', '$isi', '$status',  '$tags', '$penulis', '$fileName')");
  
      if ($insert) {
          header("Location:blog.php?kirim=sukses");    //pindah ke project.php
      } else {
          header("Location:tambah-blog.php?tambah=erorr"); //tetap di tambah-project.php
      }
    }
}

// 

if (isset($_GET['edit'])) {
    $id = $_GET['edit']; //ambil get id
    $queryEdit = mysqli_query($conn, "SELECT * FROM project WHERE id = $id");
    $row = mysqli_fetch_assoc($queryEdit);
}

if (isset($_POST['edit'])){
    $id = $_GET['edit'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $foto = $_FILES['foto'];

    unlink("../assets/uploads/" . $row['foto']);

    if ($foto['error'] == 0) {
      $fileName = uniqid() . "_" . basename($foto['name']);
      $filePath = "../assets/uploads/" . $fileName;
      move_uploaded_file($foto['tmp_name'], $filePath);
    }

    $qUpdate = mysqli_query ($conn, "UPDATE project SET nama='$nama', kategori='$kategori', foto='$fileName' WHERE id = $id");

    if($qUpdate) {
        header("Location:project.php");
    }
}

// Kategori
$queryCat = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
$rowCat = mysqli_fetch_all($queryCat, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Components / Accordion - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
<?php
  include '../inc/navbar.php';
?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
<?php
  include '../inc/sidebar.php';
?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>ADD BLOG</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title text-center"><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?>
                        Blog 
                    </h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Nama Kategori</label>
                            </div>
                            <div class="col-sm-10">
                              <!-- palai select -->
                              <select class="form-control" name="id_kategori" id="">
                                <option value="">Pilih Kategori</option>
                                  <?php foreach ($rowCat as $item) : ?>
                                    <option value="<?php echo $item['id'] ?>">
                                      <?php echo $item['nama']?>
                                    </option>
                                  <?php endforeach ?>
                              </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Judul</label>
                            </div>
                            <div class="col-sm-10">
                              <input type="text"class="form-control" name="judul" 
                              value="<?= isset($_GET['edit']) ? $row['judul'] : '' ?>">
                              </input>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Isi</label>
                            </div>
                            <div class="col-sm-10">
                              <textarea class="form-control summernote" name="isi" id=""></textarea>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Tags</label>
                            </div>
                            <div class="col-sm-10">
                              <input type="text"class="form-control" name="tags" 
                              value="<?= isset($_GET['edit']) ? $row['tags'] : '' ?>">
                              </input>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Status</label>
                            </div>
                            <div class="col-sm-10">
                            <select class="form-control" name="status" id="">
                              <option value="1" selected>Publish</option>
                              <option value="0">Draft</option>
                            </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Foto</label>
                            </div>
                            <div class="col-sm-10">
                            <input class="form-control" type="file" name="foto"
                            value="<?= isset($_GET['idEdit']) ? $row['foto'] : ''?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-2 offset-md-2">
                                <?php if (isset($_GET['edit'])) {
                                ?>
                                    <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                                <?php    
                                } else {
                                ?>
                                    <button name="simpan" type="submit" class="btn btn-primary">Simpan</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                    </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer fixed-bottom">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
  <script>
    $(".summernote").summernote({
            height: 300,
          });
  </script>     
</body>

</html>