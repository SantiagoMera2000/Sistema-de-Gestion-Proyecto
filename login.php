<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link href="css/estilo_login1.css" rel="stylesheet">
</head>
<body>
    <form action="logic/iniciar_sesion.php" method="POST">
        <div class="logo">
            <img src="img/Logo_Sistema.jpg" width="200">
            <br>
            <br>
        </div>
        <input type="text" name="usuario" placeholder="Ingrese su nombre de usuario">
        <br><br>
        <input type="password" name="clave" placeholder="Ingrese su contraseña">
        <br><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>