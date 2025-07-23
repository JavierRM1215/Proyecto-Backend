<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit;
}
?>

<?php include "layout/header.php"; ?>

<div class="container mt-4">
  <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></h1>
  <p>Este es tu panel principal.</p>
  <a href="../logout.php" class="btn btn-danger">Cerrar sesión</a>
</div>

<?php include "layout/footer.php"; ?>
