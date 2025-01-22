<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $server = $_POST['server'];
        $user = $_POST['username'];
        $passwd = $_POST['password'];

        // Crear contenido del archivo de configuración
        $configContent = "<?php\n";
        $configContent .= "define('SERVIDOR', '$server');\n";
        $configContent .= "define('USUARIO', '$user');\n";
        $configContent .= "define('PASSWORD', '$passwd');\n";
        
        $filePath = './config/configDb.php';

        $file = fopen($filePath, 'w+');
        if ($file) {
            fwrite($file, $configContent);
            fclose($file);

            $connection = new mysqli($server, $user, $passwd);

            if ($connection->connect_error) {
                throw new Exception("Error al conectar a la base de datos: ");
            }

            $connection->close();

            $command = 'php ejecutable.php';
            $output = [];
            $returnCode = 0;

            exec($command, $output, $returnCode);

            if ($returnCode === 0) {
                require_once './creacionUsuario.html';
            } else {
                throw new Exception("Error al ejecutar el script: código de retorno $returnCode. Output:\n" . implode("\n", $output));
            }
        }
    } catch (Throwable $th) {
      error_log($th->getMessage());
      $error = $th->getMessage();
      require_once '../index.php';
        die();
    }
} else {
    die('Método no permitido');
}
