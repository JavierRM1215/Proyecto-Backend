<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/proveedorController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

if (!isset($_GET['id'])) {
    header("Location: listado.php");
    exit;
}

$id = $_GET['id'];
$provCtrl = new ProveedorController();
$proveedores = $provCtrl->obtener_listado();

$proveedor = null;
foreach ($proveedores as $p) {
    if ($p['idproveedor'] == $id) {
        $proveedor = $p;
        break;
    }
}

if (!$proveedor) {
    echo "Proveedor no encontrado";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = strtoupper($_POST["txtnomproveedor"]);
    $ruc = $_POST["txtrucproveedor"];
    $dir = strtoupper($_POST["txtdirproveedor"]);
    $tel = $_POST["txttelproveedor"];
    $email = $_POST["txtemailproveedor"];

    $res = $provCtrl->actualizar_proveedor($id, $nom, $ruc, $dir, $tel, $email);

    if ($res) {
        header("Location: listado.php");
        exit;
    } else {
        echo "Error al actualizar el proveedor.";
    }
}
?>

<div class="container mt-4">
    <h2>Editar Proveedor</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nombre Proveedor:</label>
            <input type="text" class="form-control" name="txtnomproveedor" value="<?php echo $proveedor['nomproveedor']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">RUC:</label>
            <input type="text" class="form-control" name="txtrucproveedor" value="<?php echo $proveedor['rucproveedor']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Dirección:</label>
            <input type="text" class="form-control" name="txtdirproveedor" value="<?php echo $proveedor['dirproveedor']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono:</label>
            <input type="text" class="form-control" name="txttelproveedor" value="<?php echo $proveedor['telproveedor']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" name="txtemailproveedor" value="<?php echo $proveedor['emailproveedor']; ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="listado.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
