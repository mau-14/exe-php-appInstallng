<?php 

require_once './config/configDb.php';

try {

  $conexion = new mysqli(SERVIDOR,USUARIO,PASSWORD,BBDD);
  if($conexion->connect_error){
    throw new Exception('No se pudo conectar con la base de datos');
  }

  



} catch (Throwable $th) {
  error_log($th->getMessage());
  die('Se ha producido un error, revise los logs del servidor');
}
