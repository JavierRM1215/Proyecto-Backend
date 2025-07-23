<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";
?>

<div class="card">
  <div class="card-body">
    <h5>Nuevo Cliente</h5>
    <form method="POST" name="fcliente" action="grabar.php">
      <div class="mb-3">
        <label class="form-label">Nombre Cliente:</label>
        <input type="text" class="form-control" name="txtnomcliente" placeholder="Nombre Cliente">
      </div>
      <div class="mb-3">
        <label class="form-label">RUC Cliente:</label>
        <input type="text" class="form-control" name="txtrucliente" placeholder="RUC">
      </div>
      <div class="mb-3">
        <label class="form-label">Dirección:</label>
        <input type="text" class="form-control" name="txtdircliente" placeholder="Dirección">
      </div>
      <div class="mb-3">
        <label class="form-label">Teléfono:</label>
        <input type="text" class="form-control" name="txttelcliente" placeholder="Teléfono">
      </div>
      <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" class="form-control" name="txtemailcliente" placeholder="Correo electrónico">
      </div>
      <div>
        <input type="submit" class="form-button" value="Grabar">
        <input type="reset" class="form-button" value="Limpiar">
      </div>
    </form>
  </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
