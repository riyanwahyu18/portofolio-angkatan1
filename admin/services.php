<?php
require_once "../koneksi.php";
session_start();

  //middleware
// if(empty($_SESSION['EMAIL'])){
//     header("location:../login.php");
// }

$services = mysqli_query($conn, "SELECT * FROM service");
$rows = mysqli_fetch_all($services, MYSQLI_ASSOC);

//jika button simpan di klik
// if(isset($_POST['simpan'])) {
//     $nama_website = $_POST['nama_website'];
//     $alamat_website = $_POST['alamat_website'];
//     $email = $_POST['email'];
//     $tlpn = $_POST['tlpn'];
//     $alamat = $_POST['alamat'];
//     $logo = $_FILES['logo'];

//     //jika sudah mempunyain data maka update selain itu insert
//     // tampilkan / pilih data dari tabel setting, dimana nama_website = 'nilai dari nama website'
//     // tampilkan data terbaru/ terbesar / (descanding)  dari tabel user

//     if (mysqli_num_rows($querySetting) > 0){
//         //update

//         // update
//         if ($logo['error'] == 0) {
//           $fileName = uniqid() . "_" . basename($logo['name']);
//           $filePath = "../assets/uploads/" . $fileName;

//           if (move_uploaded_file($logo['tmp_name'], $filePath)){
//             $rowLogo = $rowEdt['logo'];
//             if ($rowLogo && file_exists("../assets/uploads/" . $rowLogo)){
//               unlink("../asesets/uploads/" . $rowLogo);
//           } else {
//            echo "GAGAL UPLOAD";
//           }
//           $fillQupdate = "logo='$fileName'";
//           $update = mysqli_query($conn, "UPDATE setting SET nama_website='$nama_website', alamat_website='$alamat_website', email='$email', tlpn='$tlpn', alamat='$alamat', $fillQupdate WHERE id = 1");
//           header("location:setting.php?ubah=berhasil");
//         }
//     }
// } else {
  
//     if ($logo['error'] == 0) {
//         $fileName = uniqid() . "_" . basename($logo['name']);
//         $filePath = "../assets/uploads/" . $fileName;
//         move_uploaded_file($logo['tmp_name'], $filePath);

//         $insert = mysqli_query($conn, "INSERT INTO setting(nama_website, alamat_website, email, tlpn, alamat, logo) VALUES('$nama_Website', '$alamat_website', '$email', 'tlpn', '$alamat', '$fileName')");
//         header("location:setting.php?tambah=berhasil");
//     }
//   }
// }

if (isset($_GET['del'])) {
    $id = $_GET['del'];

    $cekFOTO = mysqli_query($conn, "SELECT foto FROM service WHERE id = $id");
    $rowcekFOTO = mysqli_fetch_assoc($cekFOTO);

    if($rowEdt['foto']) {
      unlink("../assets/uploads/" . $rowcekFoto['foto']);
      $delete = mysqli_query($conn, "DELETE FROM service WHERE id = $id");
      if ($delete) {
        header("Location:service.php");
      }
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
      <h1>Services</h1>
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
                    <h5 class="card-title">Services</h5>
                    <div class="table table-responsive">
                        <a class="btn btn-primary mb-2" href="add_edit_services.php">CREATE</a>
                        <table class="table table-border">
                            <tr>
                                <th>No</th>
                                <th>Nama Services</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($rows as $row){
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama_service']?></td>
                                    <td><img widht="150" src="../assets/uploads/<?php echo $row['foto'] ?>" alt=""></td>
                                    <td>
                                    <a href="add_edit_services.php?Edit=<?php echo $row['id']?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="services.php?idDel=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>    
                            <?php 
                            }
                            ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
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

</body>

</html>