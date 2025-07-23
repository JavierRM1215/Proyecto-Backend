<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit;
}

require_once "../../controlador/UsuarioController.php";
$ctrl = new UsuarioController();

$mensaje = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $actual = $_POST['password_actual'] ?? '';
    $nueva = $_POST['password_nueva'] ?? '';
    $confirmar = $_POST['password_confirmar'] ?? '';

    if ($nueva !== $confirmar) {
        $error = "Las nuevas contraseñas no coinciden.";
    } else {
        if ($ctrl->cambiarPassword($_SESSION['usuario'], $actual, $nueva)) {
            $mensaje = "Contraseña actualizada correctamente.";
        } else {
            $error = "La contraseña actual es incorrecta.";
        }
    }
}

include_once "../layout/header.php";
include_once "../layout/navbar.php";
?>

<div class="container mt-5" style="max-width: 400px;">
    <h3 class="mb-3 text-center">Cambiar Contraseña</h3>
    <?php if ($mensaje): ?><div class="alert alert-success"><?= htmlspecialchars($mensaje) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="password_actual" class="form-label">Contraseña Actual</label>
            <input type="password" class="form-control" name="password_actual" required>
        </div>
        <div class="mb-3">
            <label for="password_nueva" class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" name="password_nueva" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmar" class="form-label">Confirmar Nueva Contraseña</label>
            <input type="password" class="form-control" name="password_confirmar" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Cambiar</button>
    </form>
</div>

<?php include_once "../layout/footer.php"; ?>
