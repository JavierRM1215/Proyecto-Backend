<?php
require_once '../includes/db.php';

try {
    $conexion = (new DBConection())->conectar();

    // Obtener todos los productos para el filtro
    $stmtProductos = $conexion->prepare("SELECT idproducto, nomproducto FROM productos");
    $stmtProductos->execute();
    $todosProductos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si se ha seleccionado un producto
    $idProductoSeleccionado = isset($_GET['idproducto']) ? $_GET['idproducto'] : '';

    // Armar consulta
    $sql = "SELECT 
                p.nomproducto AS nombre_producto,
                SUM(df.cant) AS total_vendido,
                SUM(df.cant * df.preuni) AS total_dinero
            FROM detallefactura df
            INNER JOIN productos p ON df.idproducto = p.idproducto";

    $params = [];

    if (!empty($idProductoSeleccionado)) {
        $sql .= " WHERE p.idproducto = :idproducto";
        $params[':idproducto'] = $idProductoSeleccionado;
    }

    $sql .= " GROUP BY p.nomproducto ORDER BY total_dinero DESC";

    $stmt = $conexion->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas por Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }

        .top-bar {
            background-color: #FFD700;
            padding: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .container {
            background-color: #e0e0e0;
            padding: 30px;
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

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        select, button {
            padding: 8px 12px;
            font-size: 14px;
            margin: 5px;
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            font-size: 16px;
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

    <div class="top-bar">📦 Ventas por Producto</div>

    <div class="container">
        <a class="volver" href="../index.php">⬅️ Volver</a>

        <!-- Formulario de filtro por producto -->
        <form method="GET">
            <label for="idproducto"><strong>Filtrar por producto:</strong></label>
            <select name="idproducto" id="idproducto">
                <option value="">-- Todos --</option>
                <?php foreach ($todosProductos as $prod): ?>
                    <option value="<?= $prod['idproducto'] ?>" <?= $prod['idproducto'] == $idProductoSeleccionado ? 'selected' : '' ?>>
                        <?= htmlspecialchars($prod['nomproducto']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Filtrar</button>
        </form>

        <?php if (!empty($productos)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Total Vendido (unidades)</th>
                        <th>Total Recaudado (S/.)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($productos as $prod): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($prod['nombre_producto']) ?></td>
                            <td><?= $prod['total_vendido'] ?></td>
                            <td>S/ <?= number_format($prod['total_dinero'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="no-data">No se encontraron ventas para ese producto.</p>
        <?php endif; ?>
    </div>
</body>
</html>
