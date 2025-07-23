<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sisventas/modelo/Venta.php';

class VentaController {
    private $model;

    public function __construct(){
        $this->model = new Venta();
    }

    public function registrarVenta($data){
        
        return $this->model->insertarVentaConDetalle($data);
    }
}
