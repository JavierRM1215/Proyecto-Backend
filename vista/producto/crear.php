<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/categoriaController.php";

$categoriaCtrl = new CategoriaController();
$categorias = $categoriaCtrl->obtener_listado();

?>

<div class="card">
  <div class="card-body">
    <h5>Nuevo Producto</h5>
        <form method="POST" name="fproducto" action="grabar.php">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Descripcion:</label>
            <input type="text" class="form-control" name="txtnomprodu" placeholder="Nombre Producto">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Unidad Medida:</label>
            <input type="text" class="form-control" name="txtunimed" placeholder="Unidad Medida">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Descripcion:</label>
            <input type="text" class="form-control" name="txtstock" placeholder="Stock">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Descripcion:</label>
            <input type="text" class="form-control" name="txtpreuni" placeholder="Precio Unitario">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Descripcion:</label>
            <input type="text" class="form-control" name="txtcosuni" placeholder="Costo Unitario">
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría:</label>
            <select name="idcategoria" class="form-control" required>
            <option value="">Seleccione una categoría</option>
              <?php foreach ($categorias as $cat): ?>
            <option value="<?php echo $cat['idcategoria']; ?>"><?php echo $cat['nomcategoria']; ?></option>
            <?php endforeach; ?>
           </select>
        </div>
        <div>
            <input type="submit" class="form-button" value="Grabar">
            <input type="reset" class="form-button" value="Limpiar">
        </div>
    
    </div>
</div> 
</form>

<?php  include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
