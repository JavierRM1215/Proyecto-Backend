<?php

include $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/producto.php";

class ProductoController{

    public function obtener_listado(){

        $listado = new Producto();
       $res = $listado->listado();
        return $res;

    }

    public function inserta_producto($nom, $und,$stock, $precio, $costo, $idcategoria){
        $oprodu = new Producto();
        $oprodu->setNomprodu($nom);
        $oprodu->setUnimed($und);
        $oprodu->setStock($stock);
        $oprodu->setPreuni($precio);
        $oprodu->setCosuni($costo);
        $oprodu->setidcategoria($idcategoria);

        $res =$oprodu->create();
        if ($res){
            return true;
        }
        else    
            return false;

    }

    public function eliminar_producto($id) {
    $oprodu = new Producto();
    return $oprodu->delete($id);
}

public function obtener_producto($id){
    $producto = new Producto();
    return $producto->buscar($id);
}

public function actualizar_producto($id, $nom, $unimed, $stock, $costo, $precio, $idcategoria, $estado){
    $producto = new Producto();
    $producto->setidproducto($id);
    $producto->setNomprodu($nom);
    $producto->setUnimed($unimed);
    $producto->setStock($stock);
    $producto->setCosuni($costo);
    $producto->setPreuni($precio);
    $producto->setidcategoria($idcategoria);
    $producto->setestado($estado);

    return $producto->update();
}

public function agregar_stock($idproducto, $cantidad) {
    $producto = new Producto();
    return $producto->sumar_stock($idproducto, $cantidad);
}

public function quitar_stock($idproducto, $cantidad) {
    $producto = new Producto();
    return $producto->restar_stock($idproducto, $cantidad);
}

public function obtener_todos_con_categoria() {
    $producto = new Producto();
    return $producto->productos_con_categoria();
}




}