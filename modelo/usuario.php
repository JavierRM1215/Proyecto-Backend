<?php
include_once __DIR__ . '/../includes/db.php';

class Usuario {
    private $pdo;

    public function __construct() {
        $db = new DBConection();
        $this->pdo = $db->conectar();
    }

    public function obtenerPorUsuario($usuario) {
        $sql = "SELECT * FROM usuarios WHERE nomusuario = :usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['usuario' => $usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function existeUsuario($usuario) {
        $sql = "SELECT 1 FROM usuarios WHERE nomusuario = :usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['usuario' => $usuario]);
        return $stmt->fetchColumn() !== false;
    }

    public function insertarUsuario($datos) {
        $sql = "INSERT INTO usuarios (nomusuario, password, apellidos, nombres, email, estado)
                VALUES (:nomusuario, :password, :apellidos, :nombres, :email, 'A')";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'nomusuario' => $datos['nomusuario'],
            'password' => $datos['password'],
            'apellidos' => $datos['apellidos'] ?? '',
            'nombres' => $datos['nombres'] ?? '',
            'email' => $datos['email'] ?? '',
        ]);
    }

    public function obtenerTodos() {
    $sql = "SELECT idusuario, nomusuario, apellidos, nombres, email, estado FROM usuarios";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

