<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/productoController.php";

$producto = new ProductoController();
$datos = $producto->obtener_listado();
?>

<div class="container mt-4">
    <h2>Listado de Productos</h2>
    <a href="crear.php" class="btn btn-primary mb-3">Nuevo Producto</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>IdProducto</th>
                <th>Descripcion</th>
                <th>Unidad</th>
                <th>Stock</th>
                <th>Precio Unit.</th>
                <th>Costo Unit.</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $fila): ?>
                <tr>
                    <td><?php echo $fila['idproducto']; ?></td>
                    <td><?php echo $fila['nomproducto']; ?></td>
                    <td><?php echo $fila['unimed']; ?></td>
                    <td><?php echo $fila['stock']; ?></td>
                    <td><?php echo $fila['preuni']; ?></td>
                    <td><?php echo $fila['cosuni']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $fila['idproducto']; ?>" 
                           class="btn btn-warning btn-sm">Editar</a>
                        <a href="eliminar.php?id=<?php echo $fila['idproducto']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
                           Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>


