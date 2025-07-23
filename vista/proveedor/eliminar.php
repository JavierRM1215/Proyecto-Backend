<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/proveedorController.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $provCtrl = new ProveedorController();
    $res = $provCtrl->eliminar_proveedor($id);

    if ($res) {
        header("Location: listado.php");
        exit;
    } else {
        echo "Error al eliminar el proveedor.";
    }
} else {
    echo "ID no especificado.";
}
