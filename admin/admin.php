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
<link rel="stylesheet" href="css\index.css">
<link rel="stylesheet" href="css\admin.css">


<body>
    <main class="main col">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <h5 class="card-title">Card title</h5>
                    <a style="align-self: center;" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <span class="material-symbols-outlined">
                            keyboard_arrow_down
                        </span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            hola
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

<?php include('includes/footer.php'); ?>