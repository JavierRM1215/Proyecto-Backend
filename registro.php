<?php
require_once "controlador/UsuarioController.php";

$ctrl = new UsuarioController();
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $datos = [
        'nomusuario' => $_POST['nomusuario'] ?? '',
        'password' => $_POST['password'] ?? '',
        'password2' => $_POST['password2'] ?? '',
        'apellidos' => $_POST['apellidos'] ?? '',
        'nombres' => $_POST['nombres'] ?? '',
        'email' => $_POST['email'] ?? '',
    ];

    $res = $ctrl->registrar($datos);

    if ($res === true) {
        $success = "Registro exitoso. Ya puede iniciar sesión.";
    } else {
        $error = $res;
    }
}

include "vista/login/registro.php";
