<?php include("logic/conexion.php"); ?>

<?php include('includes/header.php'); ?>

<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location: login.php");
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="css\index1.css">
<link rel="stylesheet" href="css\main.css">

<body>

        <main class="main col">
            <div class="div-config row" style="display: grid">
                <h1>Texto Bienvenida</h1>
                <a>Texto Bienvenida 2</a>
            </div>
            <div class="div-config row">
                <div class="columna col-lg-6">
                    <table>
                        <tr>
                            <td class="tabla-opciones"><img src="img\Logo_Software.png" alt="" width="75px">Opcion 1</td>
                            <td class="tabla-opciones"><a href='productos.php'><span class="material-symbols-outlined">inventory_2</span>Productos</a></td>
                            <td class="tabla-opciones"><img src="img\Logo_Software.png" alt="" width="75px">Opcion 3</td>
                        </tr>
                        <tr>
                            <td class="tabla-opciones"><img src="img\Logo_Software.png" alt="" width="75px">Opcion 4</td>
                            <td class="tabla-opciones"><img src="img\Logo_Software.png" alt="" width="75px">Opcion 5</td>
                            <td class="tabla-opciones"><img src="img\Logo_Software.png" alt="" width="75px">Opcion 6</td>
                        </tr>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/646c794df3.js"></script>
</body>

</html>