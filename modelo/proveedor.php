<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/includes/db.php";

class Proveedor {

    private $idproveedor;
    private $nomproveedor;
    private $rucproveedor;
    private $dirproveedor;
    private $telproveedor;
    private $emailproveedor;
    private $con;

    public function __construct(){
        $cnx = new DBConection();
        $this->con = $cnx->conectar();
    }

    public function listado(){
        $sql = "SELECT * FROM proveedores";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(){
        $sql = "INSERT INTO proveedores (nomproveedor, rucproveedor, dirproveedor, telproveedor, emailproveedor)
                VALUES (:nomproveedor, :rucproveedor, :dirproveedor, :telproveedor, :emailproveedor)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':nomproveedor', $this->nomproveedor);
        $stmt->bindParam(':rucproveedor', $this->rucproveedor);
        $stmt->bindParam(':dirproveedor', $this->dirproveedor);
        $stmt->bindParam(':telproveedor', $this->telproveedor);
        $stmt->bindParam(':emailproveedor', $this->emailproveedor);

        return $stmt->execute();
    }

    public function delete($id){
        $sql = "DELETE FROM proveedores WHERE idproveedor = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function update(){
        $sql = "UPDATE proveedores SET nomproveedor=?, rucproveedor=?, dirproveedor=?, telproveedor=?, emailproveedor=?
                WHERE idproveedor=?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([
            $this->nomproveedor,
            $this->rucproveedor,
            $this->dirproveedor,
            $this->telproveedor,
            $this->emailproveedor,
            $this->idproveedor
        ]);
    }

   
    public function setIdproveedor($id){ 
        $this->idproveedor = $id; }
    public function setNomproveedor($nom){ 
        $this->nomproveedor = $nom; }
    public function setRucproveedor($ruc){ 
        $this->rucproveedor = $ruc; }
    public function setDirproveedor($dir){ 
        $this->dirproveedor = $dir; }
    public function setTelproveedor($tel){ 
        $this->telproveedor = $tel; }
    public function setEmailproveedor($email){ 
        $this->emailproveedor = $email; }

 
    public function getIdproveedor(){ return 
        $this->idproveedor; }
    public function getNomproveedor(){ return 
        $this->nomproveedor; }
    public function getRucproveedor(){ return 
        $this->rucproveedor; }
    public function getDirproveedor(){ return 
        $this->dirproveedor; }
    public function getTelproveedor(){ return 
        $this->telproveedor; }
    public function getEmailproveedor(){ return 
        $this->emailproveedor; }
}
