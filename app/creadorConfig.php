<?php 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  try{

    $server = $_POST['server'];
    $user = $_POST['username'];
    $passwd = $_POST['password'];

    $configContent = "<?php\n";
    $configContent .= "define('SERVIDOR', '$server');\n";
    $configContent .= "define('USUARIO', '$user');\n";
    $configContent .= "define('PASSWORD', '$passwd');\n";
    
    $filePath = './config/prueba.php';

    $file = fopen($filePath,'w+');

    if($file){
        
      fwrite($file,$configContent);
      fclose($file);
      echo 'Archivo de configuracion creado correctamente';
    }
  }catch(Throwable $th){
    error_log($th->getMessage());
    die('Error, mire los logs del sistema');
  }
}else{
  die();
}
