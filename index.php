<!-- Se llama a la BD para establecer conexion -->
<?php include("logic/conexion.php"); ?>
<!-- Se carga el header universal de cada pagina -->
<?php include('includes/header.php'); ?>
<!-- Verifica que el usuario inició sesion, de lo contrario
lo envia de nuevo al login -->
<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location: login.php");
}
?>
<!-- Estilos requeridos especialmente en esta pagina -->
<link rel="stylesheet" href="css\index.css">

<!--
    Cambiar cantidad de productos a orden de produccion
    Crear pagina de ordenes de productos
    Realizar calculos de produccion para cada producto que
    se realizara en el evento dependiendo de los insumos
    
-->

<body>
    <main class="main col">
        <div class="div-config row" style="display: grid">
            <h1>Bienvenido !</h1>
            <h4> Has click en algunas de las tarjetas para comenzar</h4>
        </div>
        <!-- Tarjetas de acceso rapido a cada parte del sistema -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card div-config agregados">
                    <a href='recetas.php'>
                        <div class="card-body">
                        <span class="material-symbols-outlined">menu_book</span>
                            <h5 class="card-title">Recetas</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card div-config agregados">
                    <a href='productos.php'>
                        <div class="card-body">
                        <span class="material-symbols-outlined">inventory</span>
                            <h5 class="card-title">Productos</h5>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card div-config agregados">
                    <a href='insumos.php'>
                        <div class="card-body">
                        <span class="material-symbols-outlined">egg</span>
                            <h5 class="card-title">Insumos</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card div-config agregados">
                    <a href='ordenes.php'>
                        <div class="card-body">
                        <span class="material-symbols-outlined">fact_check</span>
                            <h5 class="card-title">Orden de Producción</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card div-config agregados">
                    <a href='facturacion.php'>
                        <div class="card-body">
                        <span class="material-symbols-outlined">receipt_long</span>
                            <h5 class="card-title">Facturacion</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card div-config agregados">
                    <a href='admin.php'>
                        <div class="card-body">
                        <span class="material-symbols-outlined">manage_accounts</span>
                            <h5 class="card-title">Administrador</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
    
<?php include('includes/footer.php'); ?>