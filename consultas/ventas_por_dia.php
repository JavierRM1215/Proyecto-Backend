<?php
include_once "../includes/db.php";
include_once "../vista/layout/header.php";
include_once "../vista/layout/navbar.php";

$db = new DBConection();
$pdo = $db->conectar();

$ventas = [];
$fecha = "";

if (isset($_GET['fecha']) && !empty($_GET['fecha'])) {
    $fecha = $_GET['fecha'];

    $sql = "SELECT f.idfactura, f.fecha, c.nomcliente AS cliente, 
                   p.nomproducto, (df.cant * df.preuni) AS total
            FROM facturas f
            JOIN clientes c ON f.idcliente = c.idcliente
            JOIN detallefactura df ON f.idfactura = df.idfactura
            JOIN productos p ON df.idproducto = p.idproducto
            WHERE DATE(f.fecha) = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$fecha]);
    $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container mt-4">
    <h2>📅 Ventas por Día</h2>

    <form method="GET" class="row g-2 align-items-center mb-3">
        <div class="col-auto">
            <label for="fecha" class="form-label mb-0 small">Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-control form-control-sm"
                   value="<?= htmlspecialchars($fecha) ?>" required>
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
            <?php elseif (!empty($fecha)): ?>
                <tr>
                    <td colspan="5" class="text-center text-danger">No hay ventas registradas ese día.</td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Por favor, selecciona una fecha.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include_once "../vista/layout/footer.php"; ?>