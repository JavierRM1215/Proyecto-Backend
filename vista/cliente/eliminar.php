<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/clienteController.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $clienteCtrl = new ClienteController();
    $res = $clienteCtrl->eliminar_cliente($id);

    if ($res) {
        header("Location: listado.php");
        exit;
    } else {
        echo "Error al eliminar el cliente.";
    }
} else {
    echo "ID no especificado.";
}
