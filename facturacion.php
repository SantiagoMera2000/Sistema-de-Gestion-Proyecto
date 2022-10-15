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
            <div class="col">
                <form>
                    <input type="text" id="searchTerm" onkeyup="doSearch()" placeholder="Buscar un producto" title="Buscador de productos">
                </form>
                <br>
                <table class="table table-bordered table-hover" id="datos"> 
                    <tbody>
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
                                <a href="#" class="btn btn-primary">
                                    <span class="material-symbols-outlined">add</span>
                                </a>
                                <a href="#" class="btn btn-danger">
                                    <span class="material-symbols-outlined">delete</span>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- Columna derecha -->
            <div class="col">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </main>

<script src="js\filtrador.js"></script>
<?php include('includes/footer.php'); ?>