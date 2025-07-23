<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";
?>

<div class="card">
  <div class="card-body">
    <h5>Nuevo Proveedor</h5>
    <form method="POST" action="grabar.php">
      <div class="mb-3">
        <label class="form-label">Nombre Proveedor:</label>
        <input type="text" class="form-control" name="txtnomproveedor" required>
      </div>
      <div class="mb-3">
        <label class="form-label">RUC:</label>
        <input type="text" class="form-control" name="txtrucproveedor" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Dirección:</label>
        <input type="text" class="form-control" name="txtdirproveedor" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Teléfono:</label>
        <input type="text" class="form-control" name="txttelproveedor" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" class="form-control" name="txtemailproveedor" required>
      </div>
      <input type="submit" class="btn btn-primary" value="Grabar">
      <input type="reset" class="btn btn-secondary" value="Limpiar">
    </form>
  </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>

