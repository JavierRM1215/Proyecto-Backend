<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/includes/db.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

$db = new DBConection();
$pdo = $db->conectar();

$sql = "SELECT 
            p.idproducto,
            p.nomproducto,
            p.unimed,
            p.stock,
            p.preuni,
            c.nomcategoria
        FROM productos p
        INNER JOIN categorias c ON p.idcategoria = c.idcategoria
        ORDER BY c.nomcategoria, p.nomproducto"; 

$stmt = $pdo->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);


$colores = [
    "#FFEBEE", "#E8F5E9", "#E3F2FD", "#FFF3E0", "#F3E5F5", "#F9FBE7", "#ECEFF1", "#FFF8E1"
];

$coloresCategorias = [];
$colorIndex = 0;
?>

<div class="container mt-4">
    <h4 class="mb-3">📦 Productos con su Categoría</h4>

    <?php if (!empty($productos)): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Unidad</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $prod): 
                    
                    $categoria = $prod['nomcategoria'];
                    if (!isset($coloresCategorias[$categoria])) {
                        $coloresCategorias[$categoria] = $colores[$colorIndex % count($colores)];
                        $colorIndex++;
                    }
                    $bgColor = $coloresCategorias[$categoria];
                ?>
                <tr style="background-color: <?= $bgColor ?>;">
                    <td><?= $prod['idproducto'] ?></td>
                    <td><?= htmlspecialchars($prod['nomproducto']) ?></td>
                    <td><?= htmlspecialchars($prod['unimed']) ?></td>
                    <td><?= $prod['stock'] ?></td>
                    <td>S/ <?= number_format($prod['preuni'], 2) ?></td>
                    <td><?= htmlspecialchars($categoria) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No hay productos registrados.</div>
    <?php endif; ?>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>