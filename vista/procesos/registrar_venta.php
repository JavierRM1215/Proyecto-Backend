<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/sisventas/controlador/VentaController.php';

$ctrl = new VentaController();
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'fecha' => $_POST['fecha'],
        'idcliente' => $_POST['idcliente'],
        'idusuario' => $_SESSION['idusuario'],  
        'idcondicion' => $_POST['idcondicion'],
        'valorventa' => $_POST['valorventa'],
        'igv' => $_POST['igv'],
        'detalles' => [
            [
                'idproducto' => $_POST['idproducto'],
                'cant' => $_POST['cant'],
                'cosuni' => $_POST['cosuni'],
                'preuni' => $_POST['preuni']
            ]
           
        ]
    ];

    if ($ctrl->registrarVenta($data)) {
        $mensaje = "<div class='alert alert-success'>Venta registrada correctamente.</div>";
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al registrar la venta.</div>";
    }
}

include_once $_SERVER['DOCUMENT_ROOT'].'/sisventas/vista/layout/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sisventas/vista/layout/navbar.php';
?>

<div class="container mt-4">
    <h3>Registrar Venta</h3>
    <?= $mensaje ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="idcliente" class="form-label">ID Cliente</label>
            <input type="number" id="idcliente" name="idcliente" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="idcondicion" class="form-label">ID Condición</label>
            <input type="number" id="idcondicion" name="idcondicion" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="valorventa" class="form-label">Valor Venta</label>
            <input type="number" step="0.0001" id="valorventa" name="valorventa" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="igv" class="form-label">IGV</label>
            <input type="number" step="0.0001" id="igv" name="igv" class="form-control" required />
        </div>

        <hr />
        <h5>Detalle de venta</h5>

        <div class="mb-3">
            <label for="idproducto" class="form-label">ID Producto</label>
            <input type="text" id="idproducto" name="idproducto" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="cant" class="form-label">Cantidad</label>
            <input type="number" id="cant" name="cant" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="cosuni" class="form-label">Costo Unitario</label>
            <input type="number" step="0.0001" id="cosuni" name="cosuni" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="preuni" class="form-label">Precio Unitario</label>
            <input type="number" step="0.0001" id="preuni" name="preuni" class="form-control" required />
        </div>

        <button type="submit" class="btn btn-primary">Registrar Venta</button>
    </form>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/sisventas/vista/layout/footer.php'; ?>

