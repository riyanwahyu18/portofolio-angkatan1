<?php

require_once "koneksi.php";
session_start();
session_regenerate_id(); //ini agar tidak bisa kembali ke login setelah logout

if (empty($_SESSION['EMAIL'])) {
  header("Location: login.php");
} 

$selectProfile = mysqli_query($conn, "SELECT * FROM profile");
$rows = mysqli_fetch_all($selectProfile, MYSQLI_ASSOC);

// var_dump()
if (isset($_GET['idDel'])){
    $id = $_GET['idDel'];
    $checkFoto = mysqli_query($conn, "SELECT photo FROM profile WHERE id = $id");
    $rowPhoto = mysqli_fetch_assoc($checkFoto);

    if ($rowPhoto){
        unlink("assets/uploads/" . $rowPhoto['photo']);
        $del = mysqli_query($conn, "DELETE FROM profile WHERE id= $id");
    }
if ($del){
    header("Location: profile.php");
}
}
// Status
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['idSt'];

    $update_0 = mysqli_query($conn, "UPDATE profile SET status = 0");
    $update_1 = mysqli_query($conn, "UPDATE profile SET status = 1 WHERE id = $id");

    if ($update_1) {
        header("Location: profile.php");
    } else {
        header("Location: profile.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Profil </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

<body>
<?php require_once "inc/navbar.php" ?>
<div class="container">
    <div class="row mt-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card">
                <div class="card-header text-center fw-bold "> Manage Profil </div>
                <div class="card-body">
                    <div class="mt-1 mb-1">
                        <a href="add_edit_profile.php" class="btn btn-primary"> Create </a>
                    </div>
                    <div class="table table-responsive">
                        <table class="table table-bordered text-center">
                            <tr>
                                <th> No </th>
                                <th> Photo </th>
                                <th> Nama </th>
                                <th> Jabatan </th>
                                <th> Deskripsi </th>
                                <th> Setting </th>
                            </tr>

                            <?php 
                            $no = 1;
                            foreach ($rows as $row):
                            ?>
                            <tr>
                                <td> <?= $no++ ?> </td>
                                <td> <img width="135" alt="photo" src="assets/uploads/<?= $row['photo'] ?>"> </td>
                                <td> <?= $row['nama'] ?> </td>
                                <td> <?= $row['jabatan'] ?> </td>
                                <td> <?= $row['deskripsi'] ?></td>
                                <td>
                                    <a href="add_edit_profile.php?idEdt=<?php echo base64_encode($row['id']) ?>" class="btn btn-success btn-sm"> Edit </a>
                                    <a onclick="return confirm('yakin mau happus ?')" href="profile.php?idDel=<?php echo $row['id']?>" class="btn btn-danger btn-sm"> Delete </a>
                                    <form action="?idSt=<?php echo $row ['id']?>" method="post">
                                        <input onchange="this.form.submit()" type="radio" name="status" <?php echo isset($row['status']) && $row['status'] == 1 ? 'checked' : ''?> value="1">
                                    </form>
                                </td>
                            </tr>
                            <?php
                            endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>