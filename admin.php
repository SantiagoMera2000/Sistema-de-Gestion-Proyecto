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
<!-- Ventana emergente (Modal) -->
<div class="modal fade" id="VentanaEmergente" tabindex="-1" aria-labelledby="VentanaEmergenteLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="VentanaEmergente">Añadir usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Cuerpo de la Ventana -->
      <div class="modal-body">
        <br>
        <!-- Formulario para cargar los datos en la BD -->
        <form class="formulario" enctype="multipart/form-data" action="process/cargar.php" method="POST">
          <!-- Nombre del Usuario -->
          <label class="lblnombre" for="nombre">Nombre </label>
          <input class="inpnombre" type="text" id="nom_usu" name="nom_usu" required>
          <!-- Apellido usuario -->
          <label class="lblapellido" for="apellido">Apellido</label>
          <input class="inpapellido" type="text" id="ape_usu" name="ape_usu" min=1 required>
          <!-- Email usuario -->
          <label class="lblemail" for="email">Email</label>
          <input class="email" type="email" name="email">
          <!-- clave usuario -->
          <label class="lblclave" for="clave">Contraseña</label>
          <input class="clave" type="password" name="clave" >
          <!-- Estado del Producto (Visible) -->
          <label class="form-check-label lblestado" for="estado">Visible</label>
          <div class="form-check form-switch estado">
            <input class="form-check-input" type="checkbox" role="switch" id="estado">
          </div>
          <!-- Permisos a usuarios -->
          <label class="form-check-label lblpermisos">Aplicar Permisos:</label>
          <label class="form-check-label lblpermiso_insu" for="permiso_insu">Insumos</label>
          <div class="form-check form-switch permiso_insu">
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_insu">
          </div>
          <label class="form-check-label lblpermiso_rec" for="permiso_rec">Recetas</label>
          <div class="form-check form-switch permiso_rec">
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_rec">
          </div>
          <label class="form-check-label lblpermiso_prod" for="permiso_prod">Productos</label>
          <div class="form-check form-switch permiso_prod">
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_prod">
          </div>
          <label class="form-check-label lblpermiso_orden" for="permiso_orden">Producción</label>
          <div class="form-check form-switch permiso_orden">
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_orden">
          </div>
          <label class="form-check-label lblpermiso_facturacion" for="permiso_facturacion">Facturación</label>
          <div class="form-check form-switch permiso_facturacion">
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_facturacion">
          </div>
          <label class="form-check-label lblpermiso_admin" for="permiso_admin">Administrador</label>
          <div class="form-check form-switch permiso_admin">
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_admin">
          </div>
          </select>
        </div> 
          <!-- Pie de la ventana emergente -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="cargar" name="cargar" value="usuario" >Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>


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
 <!-- ventana de confirmación -->
<div class="modal fade" id="VentanaEmergenteConfirmacion" tabindex="-1" aria-labelledby="VentanaEmergenteConfirmacion" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="VentanaEmergenteConfirmacion">Confirmar Eliminación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estas seguro de que desear eliminar este insumo?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form enctype="multipart/form-data" action="process/eliminar.php" method="POST">
          <button type="submit" class="btn btn-danger" name="eliminar_usu" id="eliminar_usu" value="">Aceptar</button>
        </form>
      </div>
    </div>
  </div>
</div>

    <main class="main col">
    <div class="card" style="Margin: 0px 15px 0px 15px;">
    <div class="card-body barra-filtros">
    <button type="button" class="btn btn-secondary btn_add"  id="cancelar1"  data-bs-toggle="modal" data-bs-target="#VentanaEmergente">Añadir</button>
    <form>
     <input class="form-control me-2" type="search" id="searchTerm" onkeyup="doSearch()" placeholder="Buscar.." title="Buscador de productos">
        </form>
    </div>
  </div>
       <br>
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
                $query = "SELECT * FROM persona where inactivo = false" ;
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
                            <button class="btn btn-tabla btn-primary" >
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button class="btn btn-tabla btn-primary eliminar_usu" data-bs-toggle="modal" data-bs-target="#VentanaEmergenteConfirmacion" role="button" data-id="<?php echo $row['id']?>">
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
<script src="js\pasar_datos_modal.js"></script>
