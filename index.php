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
            <?php
            $query = "SELECT insumos,recetas,productos,orden_de_produccion,facturacion,panel_admin from permisos where id_pe=$usuario";
            $result = mysqli_query($conexion, $query);
            while($row=mysqli_fetch_assoc($result)){
                if($row['recetas'] == true){
                echo "<div class=\"col\">";
                    echo "<div class=\"card div-config agregados\">";
                        echo "<a href='recetas.php'>";
                            echo "<div class=\"card-body\">";
                                echo "<span class=\"material-symbols-outlined\">menu_book</span>";
                                    echo "<h5 class=\"card-title\">Recetas</h5>";
                                echo "</div>";
                            echo "</a>";
                        echo "</div>";
                    echo "</div>";
                }
                if ($row['productos'] == true) {
                    echo "<div class=\"col\">";
                        echo "<div class=\"card div-config agregados\">";
                        echo "<a href='productos.php'>";
                            echo "<div class=\"card-body\">";
                                echo "<span class=\"material-symbols-outlined\">inventory</span>";
                                echo "<h5 class=\"card-title\">Productos</h5>";
                            echo "</div>";
                        echo "</a>";
                    echo "</div>";
                echo "</div>";
                }
                if ($row['insumos'] == true) {
                    echo "<div class=\"col\">";
                        echo "<div class=\"card div-config agregados\">";
                        echo "<a href='insumos.php'>";
                            echo "<div class=\"card-body\">";
                                echo "<span class=\"material-symbols-outlined\">egg</span>";
                                    echo "<h5 class=\"card-title\">Insumos</h5>";
                                echo "</div>";
                            echo "</a>";
                        echo "</div>";
                    echo "</div>";
                }
                if ($row['orden_de_produccion'] == 2) {
                    echo "<div class=\"col\">";
                        echo "<div class=\"card div-config agregados\">";
                            echo "<a href='ordenes.php'>";
                                echo "<div class=\"card-body\">";
                                    echo "<span class=\"material-symbols-outlined\">fact_check</span>";
                                echo "<h5 class=\"card-title\">Orden de Producción</h5>";
                            echo "</div>";
                        echo "</a>";
                    echo "</div>";
                echo "</div>";
                }
                if ($row['facturacion'] == true) {
                    echo "<div class=\"col\">";
                        echo "<div class=\"card div-config agregados\">";
                            echo "<a href='facturacion.php'>";
                                echo "<div class=\"card-body\">";
                                    echo "<span class=\"material-symbols-outlined\">receipt_long</span>";
                                echo "<h5 class=\"card-title\">Facturacion</h5>";
                            echo "</div>";
                        echo "</a>";
                    echo "</div>";
                echo "</div>";
                }
                if ($row['panel_admin'] == true) {
                    echo "<div class=\"col\">";
                    echo "<div class=\"card div-config agregados\">";
                        echo "<a href='admin.php'>";
                            echo "<div class=\"card-body\">";
                            echo "<span class=\"material-symbols-outlined\">manage_accounts</span>";
                                echo "<h5 class=\"card-title\">Administrador</h5>";
                            echo "</div>";
                        echo "</a>";
                    echo "</div>";
                echo "</div>";
                }
            }
            ?>
            
        </div>
    </main>
    
<?php include('includes/footer.php'); ?>