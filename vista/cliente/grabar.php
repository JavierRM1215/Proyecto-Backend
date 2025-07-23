<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/clienteController.php";

$nom = strtoupper($_POST["txtnomcliente"]);
$ru = $_POST["txtrucliente"];
$dir = strtoupper($_POST["txtdircliente"]);
$tel = $_POST["txttelcliente"];
$email = $_POST["txtemailcliente"];

$cliente = new ClienteController();
$res = $cliente->inserta_cliente($nom, $ru, $dir, $tel, $email);

if ($res) {
    header("Location: listado.php");
    exit;
} else {
    echo "Problemas al agregar cliente";
}
