<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    require_once '../config/configDb.php';
    if(!empty($_POST['password']) && !empty($_POST['correo'])){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $correo = $_POST['correo'];

        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);

        $conexion = new mysqli(SERVIDOR,USUARIO,PASSWORD,'gestionLibros');
        if($conexion->connect_error){
          throw new Exception('No se pudo conectar a la base de datos');
        }
        $conexion->set_charset('utf8');
      
        $sql = 'INSERT INTO Users (correo,permisos,password) VALUES (?,0,?)';
        $stmt = $conexion->prepare($sql);
        if(!$stmt){
          throw new Exception($conexion->error);
        }
        $stmt->bind_param('ss',$correo,$passwordHashed);
        if(!$stmt->execute()){
          throw new Exception($stmt->error);
        }
        
        echo '<form><h1>Usuario creado correctamente</h1></form>';
        $stmt->close();
        $conexion->close();
    }else{
      throw new Exception('No se han completado todos los campos');
    }     
    } catch (Throwable $th) {
      error_log($th->getMessage());
        die('Mire los logs del sistema');
    }
} else {
    die('Método no permitido');
}

