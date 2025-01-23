<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
        require_once '../config/configDb.php';
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);

        $conexion = new mysqli(SERVIDOR,USUARIO,PASSWORD,'gestionLibros');
        if($conexion->connect_error){
          throw new Exception('No se pudo conectar a la base de datos');
        }
        $conexion->set_charset('utf8');


          
    } catch (Throwable $th) {
      error_log($th->getMessage());
        die('Mire los logs del sistema');
    }
} else {
    die('Método no permitido');
}

