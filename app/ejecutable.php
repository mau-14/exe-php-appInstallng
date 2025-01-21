<?php 

require_once './config/configDb.php';

try {

  $conexion = new mysqli(SERVIDOR,USUARIO,PASSWORD);
  if($conexion->connect_error){
    throw new Exception('No se pudo conectar con la base de datos');
  }

  $sqlDirectory = './sql/';
  $sqlFiles = glob($sqlDirectory . '*.sql');

  if(empty($sqlFiles)){
    throw new Exception('No se encontro ningun archivo .sql');
  }

  foreach ($sqlFiles as $file) {
    $scriptSql = file_get_contents($file);

    if($scriptSql === false){
      throw new Exception('No se pudo leer el archivo' . $file);
    }
    
    if(!$conexion->multi_query($scriptSql)){
      throw new Exception('Error al ejecutar el script SQL del archivo '. $file);
    }
    
    do{
      if($resultado = $conexion->store_result()){
        $resultado->free();
      }
    }while($conexion->more_results() && $conexion->next_result());

    echo 'Archivo ' . $file . ' ejecutado con éxito';
  }

  echo 'Todos los archivos fuero ejecutados con éxito';

} catch (Throwable $th) {
  error_log($th->getMessage());
  die('Se ha producido un error, revise los logs del servidor');
}
