<!-- El login de momento no cargará el archivo Header.php ya que este contiene la barra de navegacion
principal y genera conflicto -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
</head>
<body>
    <!-- Formulario de inicio de sesion -->
    <form action="logic/iniciar_sesion.php" method="POST">
        <div class="logo">
            <img src="img/Logo_Sistema.png" width="120">
            <br>
            <br>
        </div>
        <input type="email" name="email" placeholder="Ingrese su correo">
        <br><br>
        <input type="password" name="clave" placeholder="Ingrese su contraseña">
        <br><br>
        <!-- DESACTIVADO POR PRUEBAS
        <?php #if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php #$_SESSION['message']?>
        </div>
        <?php #session_unset(); } ?>
        -->
        <button type="submit">Iniciar Sesión</button>
    </form>
<?php include('includes/footer.php'); ?>
