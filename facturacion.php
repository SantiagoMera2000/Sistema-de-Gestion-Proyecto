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
<link rel="stylesheet" href="css\facturacion.css">

<body>
    <main class="main">
        <div class="row align-items-start">
            <div class="col col-iz">
                <form>
                    <input class="form-control me-2" type="search" id="searchTerm" onkeyup="doSearch()" placeholder="Buscar un producto" title="Buscador de productos">
                </form>
                <br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody id="datos">
                        <?php
                        $query = "SELECT * FROM producto";
                        $result_tasks = mysqli_query($conexion, $query);    

                        while($row = mysqli_fetch_assoc($result_tasks)) { ?>
                        <tr>
                            <td class="noSearch"><?php echo $row['id_prod']; ?></td>
                            <td><?php echo $row['nom_pro']; ?></td>
                            <td class="noSearch"><?php echo $row['cantidad']; ?></td>
                            <td class="noSearch"><?php echo $row['precio_venta']; ?></td>
                            <td>
                                <button class="btn btn-tabla btn-primary envio">
                                    <span class="material-symbols-outlined">add</span>
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- Columna derecha -->
            <div class="col col-der">
                <table class="table table-bordered table-hover" id="facturar">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                </table>
                <div>
                    <p>datos</p>
                </div>
            </div>
        </div>
    </main>

<?php include('includes/footer.php'); ?>
<script src="js\filtrador.js"></script>
<script src="js\pasar_datos_tablas.js"></script>