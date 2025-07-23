<?php
include_once __DIR__ . '/../modelo/usuario.php';

class UsuarioController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Usuario();
    }

    public function login($usuario, $password) {
        $user = $this->modelo->obtenerPorUsuario($usuario);
        if ($user && $user['estado'] === 'A' && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['usuario'] = $user['nomusuario'];
            $_SESSION['idusuario'] = $user['idusuario'];
            return true;
        }
        return false;
    }

    public function registrar($datos) {
        if ($this->modelo->existeUsuario($datos['nomusuario'])) {
            return "El usuario ya existe.";
        }
        if ($datos['password'] !== $datos['password2']) {
            return "Las contraseñas no coinciden.";
        }
        $datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
        unset($datos['password2']);
        $this->modelo->insertarUsuario($datos);
        return true;
    }

    public function logout() {
        session_start();
        session_destroy();
    }

    public function cambiarPassword($usuario, $passwordActual, $passwordNuevo) {
    $db = new DBConection();
    $pdo = $db->conectar();

    
    $stmt = $pdo->prepare("SELECT password FROM usuarios WHERE nomusuario = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($passwordActual, $user['password'])) {
        return false; 
    }

   
    $hash = password_hash($passwordNuevo, PASSWORD_DEFAULT);
    $update = $pdo->prepare("UPDATE usuarios SET password = ? WHERE nomusuario = ?");
    return $update->execute([$hash, $usuario]);
}
}
