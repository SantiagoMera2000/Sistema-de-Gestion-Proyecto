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
<link rel="stylesheet" href="css\index.css">
<link rel="stylesheet" href="css\main.css">

<body>

        <main class="main col">
            <div class="div-config row" style="display: grid">
                <h1>Texto Bienvenida</h1>
                <a>Texto Bienvenida 2</a>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card div-config agregados">
                        <a href='#'>
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
                        <a href='#'>
                            <div class="card-body">
                            <span class="material-symbols-outlined">inventory_2</span>
                                <h5 class="card-title">Inventario</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card div-config agregados">
                        <a href='#'>
                            <div class="card-body">
                            <span class="material-symbols-outlined">fact_check</span>
                                <h5 class="card-title">Facturacion</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card div-config agregados">
                        <a href='#'>
                            <div class="card-body">
                            <span class="material-symbols-outlined">contact_mail</span>
                                <h5 class="card-title">Clientes</h5>
                            </div>
                        </a>
                    </div>
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