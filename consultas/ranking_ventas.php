<?php
require_once '../includes/db.php';

$db = new DBConection();
$conn = $db->conectar();

$fechaInicio = $_GET['fecha_inicio'] ?? '';
$fechaFin = $_GET['fecha_fin'] ?? '';
$idProducto = $_GET['idproducto'] ?? '';

// Obtener todos los productos para el SELECT
try {
    $stmtProd = $conn->prepare("SELECT idproducto, nomproducto FROM productos");
    $stmtProd->execute();
    $productos = $stmtProd->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al cargar productos: " . $e->getMessage());
}

// Armar la consulta con filtros
$sql = "SELECT f.idfactura, f.fecha, p.nomproducto, df.cant, df.preuni, 
               (df.cant * df.preuni) AS total
        FROM facturas f
        JOIN detallefactura df ON f.idfactura = df.idfactura
        JOIN productos p ON df.idproducto = p.idproducto
        WHERE 1=1";

$params = [];

if (!empty($fechaInicio)) {
    $sql .= " AND f.fecha >= :fecha_inicio";
    $params[':fecha_inicio'] = $fechaInicio;
}
if (!empty($fechaFin)) {
    $sql .= " AND f.fecha <= :fecha_fin";
    $params[':fecha_fin'] = $fechaFin;
}
if (!empty($idProducto)) {
    $sql .= " AND p.idproducto = :idproducto";
    $params[':idproducto'] = $idProducto;
}

$sql .= " ORDER BY total DESC";

try {
    $stmt = $conn->prepare($sql);
    foreach ($params as $key => $val) {
        $stmt->bindValue($key, $val);
    }
    $stmt->execute();
    $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}

// Clasificación de compra
function etiquetaCompra($total)
{
    if ($total > 1000) {
        return '<span style="color: green; font-weight: bold;">🟢 Mejor compra</span>';
    } elseif ($total >= 500) {
        return '<span style="color: orange; font-weight: bold;">🟡 Compra moderada</span>';
    } else {
        return '<span style="color: red; font-weight: bold;">🔴 Compra baja</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ranking de Ventas</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .top-bar {
            background-color: #FFD700;
            padding: 20px;
            color: #333;
            font-size: 28px;
            font-weight: bold;
        }
        .content {
            background-color: #e0e0e0;
            padding: 40px;
        }
        .volver {
            display: inline-block;
            margin-bottom: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            font-weight: bold;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        form {
            text-align: center;
            margin-bottom: 25px;
        }
        select, input[type="date"], button {
            padding: 8px 10px;
            margin: 0 5px;
            font-size: 14px;
        }
        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .no-data {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="top-bar">📊 Ranking de Ventas por Factura</div>

    <div class="content">
        <a class="volver" href="../index.php">⬅️ Volver</a>

        <h1>Ventas Detalladas con Filtros</h1>

        <!-- Formulario de filtros -->
        <form method="GET">
            <label for="fecha_inicio"><strong>Desde:</strong></label>
            <input type="date" name="fecha_inicio" value="<?= htmlspecialchars($fechaInicio) ?>">
            <label for="fecha_fin"><strong>Hasta:</strong></label>
            <input type="date" name="fecha_fin" value="<?= htmlspecialchars($fechaFin) ?>">

            <label for="idproducto"><strong>Producto:</strong></label>
            <select name="idproducto">
                <option value="">-- Todos --</option>
                <?php foreach ($productos as $prod): ?>
                    <option value="<?= $prod['idproducto'] ?>" <?= $prod['idproducto'] == $idProducto ? 'selected' : '' ?>>
                        <?= htmlspecialchars($prod['nomproducto']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Filtrar</button>
        </form>

        <?php if (!empty($ventas)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Factura</th>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Clasificación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($ventas as $venta) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($venta['idfactura']) ?></td>
                            <td><?= htmlspecialchars($venta['fecha']) ?></td>
                            <td><?= htmlspecialchars($venta['nomproducto']) ?></td>
                            <td><?= $venta['cant'] ?></td>
                            <td>S/ <?= number_format($venta['preuni'], 2) ?></td>
                            <td>S/ <?= number_format($venta['total'], 2) ?></td>
                            <td><?= etiquetaCompra($venta['total']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="no-data">No se encontraron ventas con los filtros seleccionados.</p>
        <?php endif; ?>
    </div>

</body>
</html>
