<?php

include $_SERVER['DOCUMENT_ROOT']."/sisventas/includes/db.php";

class Producto {

    private $idproducto;
    private $idproveedor;
    private $nomprodu;
    private $unimed;
    private $stock;
    private $cosuni;
    private $preuni;
    private $idcategoria;
    private $estado;
    private $con;

    public function __construct(){
        $cnx = new DBConection();
        $this->con = $cnx->conectar();
    }

    public function listado(){
        $sql = "select * from productos";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $resultados;
    }

    public function buscar($id){
    $sql = "SELECT * FROM productos WHERE idproducto = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(){
    $sql = "INSERT INTO productos (
                idproveedor, nomproducto, unimed, stock,
                cosuni, preuni, idcategoria, estado
            ) VALUES (
                :idproveedor, :nomproducto, :unimed, :stock,
                :cosuni, :preuni, :idcategoria, :estado
            )";
    
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':idproveedor', $this->idproveedor);
    $stmt->bindParam(':nomproducto', $this->nomprodu);
    $stmt->bindParam(':unimed', $this->unimed);
    $stmt->bindParam(':stock', $this->stock);
    $stmt->bindParam(':cosuni', $this->cosuni);
    $stmt->bindParam(':preuni', $this->preuni);
    $stmt->bindParam(':idcategoria', $this->idcategoria);
    $stmt->bindParam(':estado', $this->estado);

    if ($stmt->execute()){
        return true;
    } else {
        return false;
    }
}

    
    public function update(){
        $sql = "UPDATE productos SET
            idproveedor = :idproveedor,
            nomproducto = :nomproducto,
            unimed = :unimed,
            stock = :stock,
            cosuni = :cosuni,
            preuni = :preuni,
            idcategoria = :idcategoria,
            estado = :estado
            WHERE idproducto = :idproducto";

    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':idproveedor', $this->idproveedor);
    $stmt->bindParam(':nomproducto', $this->nomprodu);
    $stmt->bindParam(':unimed', $this->unimed);
    $stmt->bindParam(':stock', $this->stock);
    $stmt->bindParam(':cosuni', $this->cosuni);
    $stmt->bindParam(':preuni', $this->preuni);
    $stmt->bindParam(':idcategoria', $this->idcategoria);
    $stmt->bindParam(':estado', $this->estado);
    $stmt->bindParam(':idproducto', $this->idproducto);

    return $stmt->execute();
    }

    public function delete($id){
        $sql = "DELETE FROM productos WHERE idproducto = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$id]);
    }


    public function setidproducto($idpro){
        $this->idproducto = $idpro;
    }
    public function setidproveedor($idprov){
        $this->idproveedor = $idprov;
    }
    public function setNomprodu($nom){
        $this->nomprodu = $nom;
    }
    public function setUnimed($und){
        $this->unimed = $und;
    }
    public function setStock($stk){
        $this->stock = $stk;
    }
    public function setCosuni($cos){
        $this->cosuni = $cos;
    }
    public function setPreuni($pre){
        $this->preuni = $pre;
    }
    public function setidcategoria($idcat){
        $this->idcategoria = $idcat;
    }
    public function setestado($est){
        $this->estado = $est;
    }


    public function getidproducto(){
        return $this->idproducto;
    }
    public function getidproveedor(){
        return $this->idproveedor;
    }
    public function getNomprodu(){
        return $this->nomprodu;
    }
    public function getUnimed(){
        return $this->unimed;
    }
    public function getStock(){
        return $this->stock;
    }
    public function getCosuni(){
        return $this->cosuni;
    }
    public function getPreuni(){
        return $this->preuni;
    }
    public function getidcategoria(){
        return $this->idcategoria;
    }
    public function getestado(){
        return $this->estado;
    }

    public function sumar_stock($idproducto, $cantidad) {
    $sql = "UPDATE productos SET stock = stock + ? WHERE idproducto = ?";
    $stmt = $this->con->prepare($sql);
    return $stmt->execute([$cantidad, $idproducto]);
}

public function restar_stock($idproducto, $cantidad) {
    $sql = "UPDATE productos SET stock = GREATEST(stock - ?, 0) WHERE idproducto = ?";
    $stmt = $this->con->prepare($sql);
    return $stmt->execute([$cantidad, $idproducto]);
}

public function productos_con_categoria() {
    $sql = "SELECT p.*, c.nomcategoria 
            FROM productos p
            INNER JOIN categorias c ON p.idcategoria = c.idcategoria";
    $stmt = $this->con->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}