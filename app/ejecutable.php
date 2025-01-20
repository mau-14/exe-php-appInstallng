<?php 

require_once './config/configDb.php';

try {

  $conexion = new mysqli(SERVIDOR,USUARIO,PASSWORD,BBDD);
  if($conexion->connect_error){
    throw new Exception('No se pudo conectar con la base de datos');
  }

  $sqlDirectory = './sql/';
  $sqlFiles = glob($sqlDirectory . '*.sql');

  if(empty($sqlFiles)){
    throw new Exception('No se encontró ningún archivo .sql');
  }

  foreach ($sqlFiles as $file) {
    $scriptSql = file_get_contents($file);

    if($scriptSql === false){
      throw new Exception('No se pudo leer el archivo' . $file);
    }
  }

} catch (Throwable $th) {
  error_log($th->getMessage());
  die('Se ha producido un error, revise los logs del servidor');
}
