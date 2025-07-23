<?php
session_start();

require_once "controlador/UsuarioController.php";

$ctrl = new UsuarioController();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['nomusuario'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$ctrl->login($usuario, $password)) {
        $error = "Usuario o contraseña incorrectos.";
    } else {
        header("Location: vista/panel.php");
        exit;
    }
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/login/login.php"; 

