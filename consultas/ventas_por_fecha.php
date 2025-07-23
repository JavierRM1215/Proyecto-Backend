<?php
include_once "../includes/db.php";
include_once "../vista/layout/header.php";
include_once "../vista/layout/navbar.php";

$db = new DBConection();
$pdo = $db->conectar();

$ventas = [];
$desde = "";
$hasta = "";


if (isset($_GET['desde']) && isset($_GET['hasta'])) {
    $desde = $_GET['desde'];
    $hasta = $_GET['hasta'];

    $sql = "SELECT f.idfactura, f.fecha, c.nomcliente AS cliente, 
                   p.nomproducto, (df.cant * df.preuni) AS total
            FROM facturas f
            JOIN clientes c ON f.idcliente = c.idcliente
            JOIN detallefactura df ON f.idfactura = df.idfactura
            JOIN productos p ON df.idproducto = p.idproducto
            WHERE f.fecha BETWEEN ? AND ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$desde, $hasta]);
    $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container mt-4">
    <h2>📅 Ventas por Rango de Fechas</h2>

  
    <form method="GET" class="row g-2 align-items-center mb-3">
        <div class="col-auto">
            <label for="desde" class="form-label mb-0 small">Desde:</label>
            <input type="date" id="desde" name="desde" class="form-control form-control-sm"
                   value="<?= htmlspecialchars($desde) ?>" required>
        </div>

        <div class="col-auto">
            <label for="hasta" class="form-label mb-0 small">Hasta:</label>
            <input type="date" id="hasta" name="hasta" class="form-control form-control-sm"
                   value="<?= htmlspecialchars($hasta) ?>" required>
        </div>

        <div class="col-auto mt-4">
            <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
        </div>
    </form>


    <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
            <tr>
                <th>ID Factura</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ventas)): ?>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?= htmlspecialchars($venta['idfactura']) ?></td>
                        <td><?= htmlspecialchars($venta['fecha']) ?></td>
                        <td><?= htmlspecialchars($venta['cliente']) ?></td>
                        <td><?= htmlspecialchars($venta['nomproducto']) ?></td>
                        <td>S/ <?= number_format($venta['total'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php elseif (!empty($desde) && !empty($hasta)): ?>
                <tr>
                    <td colspan="5" class="text-center text-danger">No se encontraron ventas en ese rango de fechas.</td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Por favor, selecciona un rango de fechas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include_once "../vista/layout/footer.php"; ?>