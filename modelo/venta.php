<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sisventas/includes/db.php';

class Venta {
    private $pdo;

    public function __construct(){
        $this->pdo = (new DBConection())->conectar();
    }

    public function insertarVentaConDetalle($data){
        try {
            $this->pdo->beginTransaction();

          
            $stmt = $this->pdo->prepare("INSERT INTO facturas (fecha, idcliente, idusuario, fechareg, idcondicion, valorventa, igv) VALUES (?, ?, ?, NOW(), ?, ?, ?)");
            $stmt->execute([
                $data['fecha'],
                $data['idcliente'],
                $data['idusuario'],
                $data['idcondicion'],
                $data['valorventa'],
                $data['igv']
            ]);

            $idfactura = $this->pdo->lastInsertId();

         
            $stmtDetalle = $this->pdo->prepare("INSERT INTO detallefactura (idfactura, idproducto, cant, cosuni, preuni) VALUES (?, ?, ?, ?, ?)");
            foreach ($data['detalles'] as $detalle) {
                $stmtDetalle->execute([
                    $idfactura,
                    $detalle['idproducto'],
                    $detalle['cant'],
                    $detalle['cosuni'],
                    $detalle['preuni']
                ]);
            }

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            error_log("Error insertarVentaConDetalle: ".$e->getMessage());
            return false;
        }
    }
}
