<?php

include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/includes/db.php";

class CategoriaController {
    private $db;

    public function __construct() {
        $conexion = new DBConection();
        $this->db = $conexion->conectar(); 
    }


    public function obtener_listado() {
        $sql = "SELECT idcategoria, nomcategoria FROM categorias";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}