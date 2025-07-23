<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/clienteController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

$clienteCtrl = new ClienteController();
$clientes = $clienteCtrl->obtener_listado();
?>

<div class="container mt-4">
    <h2>Listado de Clientes</h2>
    <a href="crear.php" class="btn btn-primary mb-3">Nuevo Cliente</a>
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
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['idcliente']; ?></td>
                    <td><?php echo $cliente['nomcliente']; ?></td>
                    <td><?php echo $cliente['rucliente']; ?></td>
                    <td><?php echo $cliente['dircliente']; ?></td>
                    <td><?php echo $cliente['telcliente']; ?></td>
                    <td><?php echo $cliente['emailcliente']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $cliente['idcliente']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="eliminar.php?id=<?php echo $cliente['idcliente']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este cliente?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
