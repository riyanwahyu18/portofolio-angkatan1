<?php

session_start();
session_regenerate_id(); //ini agar tidak bisa kembali ke login

if (empty($_SESSION['EMAIL'])) {
  header("Location: login.php");
} 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <title>Biodata Riyan Wahyu</title>
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <header>
      <div class="row">
        <?php require_once "inc/navbar.php"?>
      </div>
    </header> <hr/>

    <div class="contact">
      <h1>Contact Me</h1>
        <div class="content">
          <form action="" method="post">
            <label for="">Email</label> <br>
            <input type="text" name="nama" id="nama" required=""/><br><br>

            <label for="">Pesan</label><br>
            <textarea name="pesan" id="pesan" style="width: 400px; height: 200px;"> </textarea> <br>

            <button type="sumbit" name="submit" id="submit" class="btn btn-success"> Kirim </button>
          </form>
        </div>  
    </div>

    <?php require_once "inc/footer.php" ?>

  </body>
</html>
