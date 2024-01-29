<?php
session_start();


if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit();
}


$correo = $_SESSION['correo'];


?>
