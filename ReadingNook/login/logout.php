<?php
session_start();
unset($_SESSION["userid"]);
setcookie('id', null, time() - 3600, "/");
unset($_COOKIE['id']); 
//perché non lo cancella?

header("Location: "."/ReadingNook/home/home.php");
?>