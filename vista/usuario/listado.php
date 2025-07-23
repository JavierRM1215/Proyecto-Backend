<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/controlador/UsuarioController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";

$ctrl = new UsuarioController();
$usuarios = $ctrl->listarUsuarios();
?>

<div class="container mt-4">
    <h2>Listado de Usuarios</h2>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Email</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['idusuario']) ?></td>
                    <td><?= htmlspecialchars($u['nomusuario']) ?></td>
                    <td><?= htmlspecialchars($u['apellidos']) ?></td>
                    <td><?= htmlspecialchars($u['nombres']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= ($u['estado'] === 'A') ? 'Activo' : 'Inactivo' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>
