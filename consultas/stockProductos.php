<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/productoController.php";

$productoCtrl = new ProductoController();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idproducto'];
    $cantidad = $_POST['cantidad'];

    if (isset($_POST['btn_sumar'])) {
        $productoCtrl->agregar_stock($id, $cantidad);
    } elseif (isset($_POST['btn_restar'])) {
        $productoCtrl->quitar_stock($id, $cantidad);
    }

    header("Location: stockProductos.php");
    exit;
}

$productos = $productoCtrl->obtener_listado();
?>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php"; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php"; ?>

<div class="container mt-5">
    <h4>Control de Stock</h4>
    <table class="table table-bordered table-hover">
        <thead >
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Unidad</th>
                <th>Stock actual</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($productos as $prod): ?>
            <tr>
                <td><?= $prod['idproducto'] ?></td>
                <td><?= htmlspecialchars($prod['nomproducto']) ?></td>
                <td><?= htmlspecialchars($prod['unimed']) ?></td>
                <td><?= $prod['stock'] ?></td>
                <td>
                    <form method="POST" class="d-flex">
                        <input type="hidden" name="idproducto" value="<?= $prod['idproducto'] ?>">
                        <input type="number" name="cantidad" class="form-control me-2" value="1" min="1" required>
                </td>
                <td>
                        <button type="submit" name="btn_sumar" class="btn btn-success btn-sm me-1">Agregar</button>
                        <button type="submit" name="btn_restar" class="btn btn-danger btn-sm">Quitar</button>


                    </form>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>