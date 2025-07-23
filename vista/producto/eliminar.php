<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/productoController.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $producto = new ProductoController();
    $res = $producto->eliminar_producto($id);

    if ($res) {
        header("Location: listado.php");
        exit;
    } else {
        echo "Error al eliminar el producto.";
    }
} else {
    echo "ID no especificado.";
}
?>
