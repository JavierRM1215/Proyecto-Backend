<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/includes/db.php";

class Cliente {

    private $idcliente;
    private $nomcliente;
    private $rucliente;
    private $dircliente;
    private $telcliente;
    private $emailcliente;
    private $con;

    public function __construct(){
        $cnx = new DBConection();
        $this->con = $cnx->conectar();
    }

    public function listado(){
        $sql = "SELECT * FROM clientes";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(){
        $sql = "INSERT INTO clientes (nomcliente, rucliente, dircliente, telcliente, emailcliente)
                VALUES (:nomcliente, :rucliente, :dircliente, :telcliente, :emailcliente)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':nomcliente', $this->nomcliente);
        $stmt->bindParam(':rucliente', $this->rucliente);
        $stmt->bindParam(':dircliente', $this->dircliente);
        $stmt->bindParam(':telcliente', $this->telcliente);
        $stmt->bindParam(':emailcliente', $this->emailcliente);

        return $stmt->execute();
    }

    public function delete($id){
        $sql = "DELETE FROM clientes WHERE idcliente = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function update(){
        $sql = "UPDATE clientes SET nomcliente=?, rucliente=?, dircliente=?, telcliente=?, emailcliente=?
                WHERE idcliente=?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([
            $this->nomcliente,
            $this->rucliente,
            $this->dircliente,
            $this->telcliente,
            $this->emailcliente,
            $this->idcliente
        ]);
    }

    
    public function setIdcliente($id){ 
        $this->idcliente = $id; }
    public function setNomcliente($nom){ 
        $this->nomcliente = $nom; }
    public function setRucliente($ru){ 
        $this->rucliente = $ru; }
    public function setDircliente($dir){ 
        $this->dircliente = $dir; }
    public function setTelcliente($tel){ 
        $this->telcliente = $tel; }
    public function setEmailcliente($email){ 
        $this->emailcliente = $email; }


    public function getIdcliente(){ 
        return $this->idcliente; }
    public function getNomcliente(){ 
        return $this->nomcliente; }
    public function getRucliente(){ 
        return $this->rucliente; }
    public function getDircliente(){ 
        return $this->dircliente; }
    public function getTelcliente(){ 
        return $this->telcliente; }
    public function getEmailcliente(){ 
        return $this->emailcliente; }
}
