 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalacion App</title>
    <link rel="stylesheet" href="/dwens/ejecutableInstalacionApp/css/style.css">
</head>
<body>
    <div class="map-container" id="map-container">
        <h1>Conectar al Servidor</h1>
        <form action='/dwens/ejecutableInstalacionApp/app/creadorConfig.php' method="post">
            <label for="server">Servidor:</label>
            <input type="text" id="server" name="server" required>

            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Conectar">
        </form>
        <?php 
        echo '<label style="color:red;">'. $error . '</label>';

        ?>
    </div>
</body>
</html>
