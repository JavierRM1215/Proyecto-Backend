<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/proveedorController.php";

$nom = strtoupper($_POST["txtnomproveedor"]);
$ruc = $_POST["txtrucproveedor"];
$dir = strtoupper($_POST["txtdirproveedor"]);
$tel = $_POST["txttelproveedor"];
$email = $_POST["txtemailproveedor"];

$prov = new ProveedorController();
$res = $prov->inserta_proveedor($nom, $ruc, $dir, $tel, $email);

if ($res) {
    header("Location: listado.php");
    exit;
} else {
    echo "Problemas al agregar proveedor";
}
