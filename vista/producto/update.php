<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/productoController.php";

$productoCtrl = new ProductoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar actualización
    $id = $_POST['idproducto'];
    $nom = $_POST['nomproducto'];
    $unimed = $_POST['unimed'];
    $stock = $_POST['stock'];
    $costo = $_POST['cosuni'];
    $precio = $_POST['preuni'];
    $idcategoria = $_POST['idcategoria'];
    $estado = $_POST['estado'];

    $res = $productoCtrl->actualizar_producto($id, $nom, $unimed, $stock, $costo, $precio, $idcategoria, $estado);
    if ($res) {
        header("Location: listado.php");
        exit;
    } else {
        $message = "Error al actualizar el producto.";
        $class = "alert alert-danger";
    }
} else if (isset($_GET['id'])) {
   
    $id = $_GET['id'];
    $producto = $productoCtrl->obtener_producto($id);
    if (!$producto) {
        die("Producto no encontrado.");
    }
} else {
    header("Location: listado.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: #f7f7f7;
            padding: 20px 0;
        }
        .container {
            max-width: 700px;
            background: #fff;
            padding: 30px 40px;
            border-radius: 6px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            font-weight: 700;
            margin-bottom: 25px;
            color: #333;
        }
        label {
            font-weight: 600;
            color: #555;
        }
        .btn-primary {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-primary:hover {
            background-color: #003d7a;
            border-color: #002752;
        }
        .btn-back {
            margin-bottom: 25px;
        }
        .alert {
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <a href="listado.php" class="btn btn-info btn-back">
        <i class="fa fa-arrow-left"></i> Regresar al listado
    </a>
    <h2><i class="fa fa-pencil-square-o"></i> Editar <b>Producto</b></h2>

    <?php if (isset($message)) : ?>
        <div class="<?php echo $class; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="update.php">
        <input type="hidden" name="idproducto" value="<?php echo $producto['idproducto']; ?>">

        <div class="form-group">
            <label for="nomproducto">Nombre del producto</label>
            <input type="text" name="nomproducto" id="nomproducto" class="form-control" required maxlength="100" value="<?php echo htmlspecialchars($producto['nomproducto']); ?>">
        </div>

        <div class="form-group">
            <label for="unimed">Unidad de medida</label>
            <input type="text" name="unimed" id="unimed" class="form-control" required maxlength="20" value="<?php echo htmlspecialchars($producto['unimed']); ?>">
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" required min="0" value="<?php echo (int)$producto['stock']; ?>">
        </div>

        <div class="form-group">
            <label for="cosuni">Costo unitario</label>
            <input type="text" name="cosuni" id="cosuni" class="form-control" required value="<?php echo htmlspecialchars($producto['cosuni']); ?>">
        </div>

        <div class="form-group">
            <label for="preuni">Precio unitario</label>
            <input type="text" name="preuni" id="preuni" class="form-control" required value="<?php echo htmlspecialchars($producto['preuni']); ?>">
        </div>

        <div class="form-group">
            <label for="idcategoria">Categoría (ID)</label>
            <input type="number" name="idcategoria" id="idcategoria" class="form-control" required min="1" value="<?php echo (int)$producto['idcategoria']; ?>">
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="1" <?php if($producto['estado'] == 1) echo 'selected'; ?>>Activo</option>
                <option value="0" <?php if($producto['estado'] == 0) echo 'selected'; ?>>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            <i class="fa fa-floppy-o"></i> Actualizar Producto
        </button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
