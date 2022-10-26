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

    <!-- Ventana para ver y editar producto -->
<div class="modal fade" id="VentanaEmergenteVisualizar" data-bs-backdrop="static" tabindex="-1" aria-labelledby="VentanaEmergenteVisualizar" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="VentanaEmergenteVisualizar">Ver permisos del usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Cuerpo de la Ventana -->
            <div class="modal-body">
                <br>
                <!-- Formulario para cargar los datos en la BD -->
                <form id="formE" class="formulario" enctype="multipart/form-data" action="editar.php" method="POST">
                    <?php echo $id ?>
                    $query = "SELECT * FROM permisos WHERE id_pe = $id";
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Default checkbox</label>
                    </div>
                    
                </form>
            </div>
            <!-- Pie de la ventana emergente -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onClick="this.form.reset()" id="cancelar1" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="editar" name="editar" value="producto" >Completar edición</button>
            </div>
        </div>
    </div>
</div>


    <main class="main col">
        <form>
            <input class="form-control me-2" type="search" id="searchTerm" onkeyup="doSearch()" placeholder="Buscar.." title="Buscador de productos">
        </form><br>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Mail</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody id="datos">
                <?php
                $query = "SELECT * FROM persona";
                $result_tasks = mysqli_query($conexion, $query);    

                while($row = mysqli_fetch_assoc($result_tasks)) { ?>
                    <tr>
                        <td class="noSearch"><?php echo $row['id']; ?></td>
                        <td class="noSearch"><?php echo $row['nombre']; ?></td>
                        <td class="noSearch"><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <button class="btn btn-tabla btn-primary" data-bs-toggle="modal" data-bs-target="#VentanaEmergenteVisualizar" role="button">
                                <span class="material-symbols-outlined" value="<?php echo $row['id']?>">account_tree</span>
                            </button>
                            <button class="btn btn-tabla btn-primary">
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button class="btn btn-tabla btn-primary">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>

<?php include('includes/footer.php'); ?>
<script src="js\filtrador.js"></script>