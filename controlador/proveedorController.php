<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/proveedor.php";

class ProveedorController {

    public function obtener_listado(){
        $prov = new Proveedor();
        return $prov->listado();
    }

    public function inserta_proveedor($nom, $ruc, $dir, $tel, $email){
        $oprov = new Proveedor();
        $oprov->setNomproveedor($nom);
        $oprov->setRucproveedor($ruc);
        $oprov->setDirproveedor($dir);
        $oprov->setTelproveedor($tel);
        $oprov->setEmailproveedor($email);

        return $oprov->create();
    }

    public function eliminar_proveedor($id){
        $oprov = new Proveedor();
        return $oprov->delete($id);
    }

    public function actualizar_proveedor($id, $nom, $ruc, $dir, $tel, $email){
        $oprov = new Proveedor();
        $oprov->setIdproveedor($id);
        $oprov->setNomproveedor($nom);
        $oprov->setRucproveedor($ruc);
        $oprov->setDirproveedor($dir);
        $oprov->setTelproveedor($tel);
        $oprov->setEmailproveedor($email);

        return $oprov->update();
    }
}
