<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";
require_once $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/VentaController.php";

$ventaCtrl = new VentaController();
$ventas = [];
$fechaSeleccionada = '';

if (isset($_GET['fecha'])) {
    $fechaSeleccionada = $_GET['fecha'];
    $ventas = $ventaCtrl->ventasPorDia($fechaSeleccionada);
}
?>

<div class="container mt-4">
    <h2>Consultar ventas por día</h2>
    <form method="GET" class="mb-3">
        <label for="fecha">Seleccione una fecha:</label>
        <input type="date" name="fecha" id="fecha" value="<?= htmlspecialchars($fechaSeleccionada) ?>" required>
        <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
    </form>

    <?php if ($fechaSeleccionada): ?>
        <?php if ($ventas): ?>
            <h4>Ventas del <?= htmlspecialchars($fechaSeleccionada) ?></h4>
            <table class="table table-bordered">
                <thead>
                    <tr><th>ID Factura</th><th>Cliente</th><th>Total</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?= htmlspecialchars($venta['idfactura']) ?></td>
                            <td><?= htmlspecialchars($venta['nomcliente']) ?></td>
                            <td>S/ <?= htmlspecialchars($venta['totalfactura']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-danger">No se encontraron ventas para esta fecha.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
