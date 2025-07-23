<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/navbar.php";


echo "<div class='container mt-5'><h3>Bienvenido, " . htmlspecialchars($_SESSION['usuario']) . "</h3></div>";

include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php";



