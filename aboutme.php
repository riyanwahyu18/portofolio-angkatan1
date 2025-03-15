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
      <h1>About Me</h1>
      <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatibus voluptates, sed at iste iusto fugiat architecto doloremque maiores mollitia numquam? Suscipit odit rem tenetur eligendi repudiandae, quod enim similique corrupti velit et aliquam necessitatibus beatae quidem animi magni fugiat non corporis eveniet accusamus, exercitationem architecto accusantium. Deleniti ut ipsa autem ducimus nostrum quod earum quos doloremque labore. Soluta laboriosam consectetur, voluptatem quasi provident corrupti ipsum cumque! Porro accusantium, vel, aut nihil nam distinctio blanditiis deserunt sunt voluptatem voluptas magnam culpa! Quibusdam optio cupiditate voluptatem soluta quos quam, omnis illo adipisci neque sapiente pariatur iure fugit error ipsum cumque autem quis. Nihil cum quisquam libero sint eos voluptatibus officia provident soluta excepturi at. Officiis possimus cupiditate voluptatum mollitia sed amet culpa excepturi consectetur, quisquam dignissimos fugit. Magni ratione corrupti in odit atque pariatur dicta at quas vero, beatae culpa incidunt repellendus vel quam id! Sequi, sed! Eligendi adipisci officia fugit iure sunt mollitia in, quae quam, hic debitis dolor porro quasi beatae rem voluptatum repudiandae voluptate labore voluptas inventore. Harum similique tempore necessitatibus ex et in delectus ab iure ullam adipisci, possimus reiciendis repellendus quidem illo rem? Vitae officiis voluptate tenetur cum debitis consectetur error rem voluptates atque corrupti, qui repellendus ex dicta exercitationem ducimus illo adipisci vel sed, in deserunt sequi? Alias asperiores enim ipsam atque inventore, illum aspernatur itaque eveniet sequi, dolorum fuga deleniti repellendus vel facere accusamus sunt corporis recusandae magni doloribus nostrum eos fugit modi maxime. Cumque nisi ullam quisquam temporibus sint harum .</p>
    </div>

    <?php require_once "inc/footer.php" ?>

  </body>
</html>
