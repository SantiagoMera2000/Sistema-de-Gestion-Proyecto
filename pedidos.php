<?php include("logic/conexion.php"); ?>

<?php include('includes/header.php'); ?>

<!-- Estilos requeridos especialmente en esta pagina -->
<link rel="stylesheet" href="css\index.css">
<link rel="stylesheet" href="css\pedidos.css">

<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
        <div class="card div-config agregados">
            <a href='#'>
                <div class="card-body">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <h5 class="card-title">Pedidos</h5>
                </div>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="card div-config agregados">
            <a href='#'>
                <div class="card-body">
                    <span class="material-symbols-outlined">list_alt</span>
                    <h5 class="card-title">Mis Pedidos</h5>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>