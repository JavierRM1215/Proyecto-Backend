<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/proveedorController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

$provCtrl = new ProveedorController();
$proveedores = $provCtrl->obtener_listado();
?>

<div class="container mt-4">
    <h2>Listado de Proveedores</h2>
    <a href="crear.php" class="btn btn-primary mb-3">Nuevo Proveedor</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>RUC</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proveedores as $prov): ?>
                <tr>
                    <td><?php echo $prov['idproveedor']; ?></td>
                    <td><?php echo $prov['nomproveedor']; ?></td>
                    <td><?php echo $prov['rucproveedor']; ?></td>
                    <td><?php echo $prov['dirproveedor']; ?></td>
                    <td><?php echo $prov['telproveedor']; ?></td>
                    <td><?php echo $prov['emailproveedor']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $prov['idproveedor']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="eliminar.php?id=<?php echo $prov['idproveedor']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este proveedor?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
