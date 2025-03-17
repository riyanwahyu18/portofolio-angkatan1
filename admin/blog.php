<?php
require_once "../koneksi.php";
session_start();

$query = mysqli_query($conn, "SELECT blog.*, categories.nama FROM blog LEFT JOIN categories ON blog.id_kategori = categories.id");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

// $row = mysqli_fetch_assoc($resume);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $queryProject = mysqli_query($conn, "SELECT * FROM blog WHERE id = $id");
    $rowProject = mysqli_fetch_assoc($queryProject);
    unlink('../assets/uploads/' . $rowProject['foto']);

    $delete = mysqli_query($conn, "DELETE FROM blog WHERE id = $id"); //Insert, Delete, Update, Select pakai query
    if ($delete) {
        header("Location:project.php?hapus=berhassil");
    } 
}
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
      <h1>Project</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Project</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title text-center"> Data Blog</h5>
                    <div class="table table-responsive">
                        <div class="d-flex justify-content-end mb-2">
                            <a class="btn btn-primary mb-2" href="tambah-blog.php">Tambah Blog</a>
                        </div>
                        <table class="table table-bordered text-center" id="myTable">
                        <thead>    
                          <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Status</th>
                                <th>Foto</th>
                                <th>Action</th>
                          </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1; // variable no awal
                            foreach ($rows as $row){ //perulangan 
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['id_kategori']?></td>
                                    <td><?= $row['judul']?></td>
                                    <td><?= $row['penulis']?></td>
                                    <td>
                                      <?php 
                                      switch ($row['status']){
                                        case '1':
                                          $label = "<span class='badge bg-primary'> Publish </span>";
                                          break;
                                        default:
                                          $label = "<span class='badge bg-primary'> Publish </span>";
                                          break;
                                      }
                                      echo $label;
                                      ?>  
                                    </td>
                                    <td><img width="180" src="../assets/uploads/<?php echo $row['foto'] ?>"></td>
                                    <td>

                                    <a href="tambah-project.php?edit=<?= $row['id']?>" class="btn btn-success">Edit</a>
                                    <a href="project.php?delete=<?= $row['id'] ?>" onclick="confirm('Yakin Mau Hapus Bro?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>    
                            <?php 
                            }
                            ?>
                            </tbody>
                        </table>
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


  <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
  <!-- Vendor JS Files -->
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
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.js" integrity="sha384-k90VzuFAoyBG5No1d5yn30abqlaxr9+LfAPp6pjrd7U3T77blpvmsS8GqS70xcnH" crossorigin="anonymous"></script>
    <script>
        let dataTable = new DataTable("#myTable");
    </script>

</body>

</html>