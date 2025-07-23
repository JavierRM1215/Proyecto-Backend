<?php
require_once '../includes/db.php';

try {
    $conexion = (new DBConection())->conectar();

    // Obtener lista de clientes para el filtro
    $stmtClientes = $conexion->prepare("SELECT idcliente, nomcliente FROM clientes");
    $stmtClientes->execute();
    $clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);

    $idClienteSeleccionado = $_GET['idcliente'] ?? '';

    $sql = "SELECT 
                c.idcliente,
                c.nomcliente AS cliente,
                c.dircliente AS direccion,
                c.emailcliente AS correo,
                SUM(f.valorventa) AS total_venta,
                SUM(f.igv) AS total_igv
            FROM clientes c
            INNER JOIN facturas f ON c.idcliente = f.idcliente";

    $params = [];

    if (!empty($idClienteSeleccionado)) {
        $sql .= " WHERE c.idcliente = :idcliente";
        $params[':idcliente'] = $idClienteSeleccionado;
    }

    $sql .= " GROUP BY c.idcliente, c.nomcliente, c.dircliente, c.emailcliente ORDER BY total_venta DESC";

    $stmt = $conexion->prepare($sql);
    foreach ($params as $key => $val) {
        $stmt->bindValue($key, $val);
    }

    $stmt->execute();
    $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas por Cliente</title>
    <link rel="stylesheet" href="../estilos/main.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
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

    <div class="top-bar">🧾 Ventas por Cliente</div>

    <div class="container">
        <a class="volver" href="../index.php">⬅️ Volver</a>

        <!-- Filtro -->
        <form method="GET">
            <label for="idcliente"><strong>Filtrar por cliente:</strong></label>
            <select name="idcliente" id="idcliente">
                <option value="">-- Todos --</option>
                <?php foreach ($clientes as $cli): ?>
                    <option value="<?= $cli['idcliente'] ?>" <?= $cli['idcliente'] == $idClienteSeleccionado ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cli['nomcliente']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Filtrar</button>
        </form>

        <!-- Tabla -->
        <?php if (!empty($ventas)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Total Venta (S/)</th>
                        <th>Total IGV (S/)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($ventas as $fila): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($fila['idcliente']) ?></td>
                            <td><?= htmlspecialchars($fila['cliente']) ?></td>
                            <td><?= htmlspecialchars($fila['direccion']) ?></td>
                            <td><?= htmlspecialchars($fila['correo']) ?></td>
                            <td><?= number_format($fila['total_venta'], 2) ?></td>
                            <td><?= number_format($fila['total_igv'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="no-data">No hay datos disponibles.</p>
        <?php endif; ?>
    </div>
</body>
</html>
