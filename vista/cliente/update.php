<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/clienteController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

if (!isset($_GET['id'])) {
    header("Location: listado.php");
    exit;
}

$id = $_GET['id'];
$clienteCtrl = new ClienteController();
$clientes = $clienteCtrl->obtener_listado();

$cliente = null;
foreach ($clientes as $c) {
    if ($c['idcliente'] == $id) {
        $cliente = $c;
        break;
    }
}

if (!$cliente) {
    echo "Cliente no encontrado";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = strtoupper($_POST["txtnomcliente"]);
    $ru = $_POST["txtrucliente"];
    $dir = strtoupper($_POST["txtdircliente"]);
    $tel = $_POST["txttelcliente"];
    $email = $_POST["txtemailcliente"];

    $res = $clienteCtrl->actualizar_cliente($id, $nom, $ru, $dir, $tel, $email);

    if ($res) {
        header("Location: listado.php");
        exit;
    } else {
        echo "Error al actualizar el cliente.";
    }
}
?>

<div class="container mt-4">
    <h2>Editar Cliente</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nombre Cliente:</label>
            <input type="text" class="form-control" name="txtnomcliente" value="<?php echo $cliente['nomcliente']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">RUC Cliente:</label>
            <input type="text" class="form-control" name="txtrucliente" value="<?php echo $cliente['rucliente']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Dirección:</label>
            <input type="text" class="form-control" name="txtdircliente" value="<?php echo $cliente['dircliente']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono:</label>
            <input type="text" class="form-control" name="txttelcliente" value="<?php echo $cliente['telcliente']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" name="txtemailcliente" value="<?php echo $cliente['emailcliente']; ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="listado.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
