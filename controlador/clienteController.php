<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/cliente.php";

class ClienteController {

    public function obtener_listado(){
        $cliente = new Cliente();
        return $cliente->listado();
    }

    public function inserta_cliente($nom, $ru, $dir, $tel, $email){
        $ocliente = new Cliente();
        $ocliente->setNomcliente($nom);
        $ocliente->setRucliente($ru);
        $ocliente->setDircliente($dir);
        $ocliente->setTelcliente($tel);
        $ocliente->setEmailcliente($email);

        return $ocliente->create();
    }

    public function eliminar_cliente($id){
        $ocliente = new Cliente();
        return $ocliente->delete($id);
    }

    public function actualizar_cliente($id, $nom, $ru, $dir, $tel, $email){
        $ocliente = new Cliente();
        $ocliente->setIdcliente($id);
        $ocliente->setNomcliente($nom);
        $ocliente->setRucliente($ru);
        $ocliente->setDircliente($dir);
        $ocliente->setTelcliente($tel);
        $ocliente->setEmailcliente($email);

        return $ocliente->update();
    }
}
