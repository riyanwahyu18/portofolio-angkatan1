<?php

session_start();
session_destroy(); //ini agar setelah login tidak bisa kembali

header("Location: login.php");

?>
