<?php include("logic/conexion.php"); ?>

<?php include('includes/header.php'); ?>

<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
  header("location: login.php");
}
$query = "SELECT productos from permisos where id_pe=$usuario";
$result = mysqli_query($conexion, $query);
while($row=mysqli_fetch_assoc($result)){
  if($row['productos'] == false){
    echo $row['productos'];
    header("location: index.php");
  }
}
?>
<link rel="stylesheet" href="css\productos.css">

<!-- Ventana emergente (Modal) -->
<div class="modal fade " id="VentanaEmergente" data-bs-backdrop="static" tabindex="-1" aria-labelledby="VentanaEmergente" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="VentanaEmergente">Agregar un Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Cuerpo de la Ventana -->
      <div class="modal-body">
        <br>
        <!-- Formulario para cargar los datos en la BD -->
        <form id="form" class="formulario" enctype="multipart/form-data" action="process/cargar.php" method="POST">
          <!-- Imagen del Producto -->
          <input class="imagen rounded form-control" name="imagen" type="file" id="imagen"/>
          <div class="vistaprevia rounded" id="imagepreview"></div>
          <!-- Nombre del Producto -->
          <label class="lblnom" for="nombre">Nombre</label>
          <input class="innom form-control" type="text" id="nombre" name="nombre" required>
          <!-- Receta del Producto -->
          <label class="lblreceta" for="receta">Receta </label>
          <select class="form-select selreceta" aria-label="Recetas disponibles" id="receta" name="receta" required>
            <option selected> Seleccionar</option>
            <?php 
            $query = "SELECT id_rec,nom_r FROM receta WHERE inactivo = 0 ORDER BY id_rec DESC";
            $result_tasks = mysqli_query($conexion, $query);    
            while($row = mysqli_fetch_assoc($result_tasks)) { ?>
            <option value="<?php echo $row['id_rec']?>"><?php echo $row['nom_r']?></option>
            <?php } ?>
          </select>
          <label class="lbldesc" for="descri_pro">Descripci??n </label>
          <input class="inpdesc form-control" type="text" id="descr" name="descr" required>
          <!-- Tipo del Producto (Comida,Bebida,etc) -->
          <label class="lbltipo" for="tipo">Categoria </label>
          <input class="inptipo form-control" type="text" id="tipo" name="tipo" required>
          <!-- Precio de Elaboracion -->
          <label class="lblelab" for="precio_elab">Precio de elaboraci??n </label>
          <input class="inpelab form-control" type="number" id="precio_elab" name="precio_elab" required>
          <!-- Precio de Venta -->
          <label class="lblventa" for="precio_venta">Precio de venta </label>
          <input class="inpventa form-control" type="number" id="precio_venta" name="precio_venta" required>
          <!-- Cantidad de Productos -->
          <label class="lblcant" for="cantidad">Cantidad </label>
          <input class="inpcant form-control" type="text" id="cantidad" name="cantidad" min="1" required>
          <!-- Estado del Producto (Visible) -->
          <label class="form-check-label lblestado" for="estado">Visibilidad</label>
          <div class="form-check form-switch estado">
            <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado">
          </div>
        </div>
          <!-- Pie de la ventana emergente -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onClick="this.form.reset()" id="cancelar" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="cargar" name="cargar" value="producto" >Agregar</button>
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
        <h5 class="modal-title">Ver un Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Cuerpo de la Ventana -->
      <div class="modal-body">
        <br>
        <!-- Formulario para cargar los datos en la BD -->
        <form id="formE" class="formulario" enctype="multipart/form-data" action="process/editar.php" method="POST">
          <!-- Imagen del Producto -->
          <input class="imagen rounded form-control" name="imagenE" type="file" id="imagenE"/>
          <div class="vistaprevia rounded" id="imagepreviewE">
          </div>
          <!-- Nombre del Producto -->
          <label class="lblnom" for="nombre">Nombre </label>
          <input class="inpnom form-control" type="text" id="nombreE" name="nombreE" value="">
          <!-- Receta del Producto -->
          <label class="lblreceta" for="nombre">Receta </label>
          <input class="selreceta form-control" type="text" id="recetaE" name="recetaE" value="" disabled>
          <!-- Descripci??n del producto -->
          <label class="lbldesc" for="descr">Descripci??n </label>
          <input class="impdesc form-control" type="text" id="descrE" name="descrE" value="">
          <!-- Tipo del Producto (Comida,Bebida,etc) -->
          <label class="lbltipo" for="tipo">Categoria </label>
          <input class="inptipo form-control" type="text" id="tipoE" name="tipoE" value="">
          <!-- Precio de Elaboracion -->
          <label class="lblelab" for="precio_elab">Precio de Elaboraci??n </label>
          <input class="inpelab form-control" type="number" id="precio_elabE" name="precio_elabE" min=1 value="">
          <!-- Precio de Venta -->
          <label class="lblventa" for="precio_venta">Precio de Venta </label>
          <input class="inpventa form-control" type="number" id="precio_ventaE" name="precio_ventaE" min=1 value="">
          <!-- Cantidad de Productos -->
          <label class="lblcant" for="cantidad">Cantidad </label>
          <input class="inpcant form-control" type="text" id="cantidadE" name="cantidadE" min="1" value="">
          <!-- Estado del Producto (Visible) -->
          <label class="form-check-label lblestado" for="estado">Visibilidad</label>
          <div class="form-check form-switch estado">
            <input class="form-check-input" type="checkbox" role="switch" id="estadoE" name="estadoE">
          </div>
          <input type="text" id="id_prod" name="id_prod" value="" hidden>
        </div>
          <!-- Pie de la ventana emergente -->
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" id="modoeditar" data-bs-toggle="button">Activar Edici??n</button>
            <button type="button" class="btn btn-secondary" onClick="this.form.reset()" id="cancelar1" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="editar" name="editar" value="producto" >Completar edici??n</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- Ventana Modal de Confirmacion -->
<div class="modal fade" id="VentanaEmergenteConfirmacion" tabindex="-1" aria-labelledby="VentanaEmergenteConfirmacion" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="VentanaEmergenteConfirmacion">Confirmar Eliminaci??n</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ??Estas seguro de que desear eliminar este producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form enctype="multipart/form-data" action="process/eliminar.php" method="POST">
          <button type="submit" class="btn btn-danger" name="eliminar_prod" id="eliminar_prod" value="">Aceptar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Contenedor principal -->
<main class="main">
  <div class="card" style="Margin: 0px 15px 0px 15px;">
    <div class="card-body barra-filtros">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="mostrarocultos" onclick="mostraroculto()">
        <label class="form-check-label" for="mostrarocultos">Mostrar Agotados/Ocultos</label>
      </div>
    </div>
  </div>
  <br>
  <div class="row row-cols-1 row-cols-md-6 g-4">
    <div class="col agregar">
      <!-- Tarjeta para agregar los productos (Llama a la ventana emergente) -->
      <div class="card h-100 ajustes">
        <div class="card-body">
          <h5 class="card-title">Agregar un Producto</h5>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#VentanaEmergente">
            <span class="material-symbols-outlined agrandar-icono">add</span>
          </button>
        </div>
      </div>
    </div>
    <?php
      $query = "SELECT * FROM producto ORDER BY inactivo,nom_pro ASC";
      $result_tasks = mysqli_query($conexion, $query);    
      while($row = mysqli_fetch_assoc($result_tasks)) { ?>
      <!-- Tarjetas donde se cargan los datos de la BD -->
          <?php
          if ($row['inactivo'] == false) {
            echo "<div class=\"col tarjeta\">";
          } else {
            echo "<div class=\"col inactivo oculto tarjeta\">";
          }
          ?>
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nom_pro']; ?></h5>
              <hr>
              <?php
              if ($row['img_id'] == "") {
                echo "<span class=\"material-symbols-outlined agrandar-icono\">image_not_supported</span>";
              } else {
                echo "<img class=\"img-preview rounded card-img-top img-fluid\" src='data:img/jpg;base64, ".base64_encode($row['img_id'])."' alt=\"{$row['nom_pro']}\">";
              }
              ?>
              <p class="card-text"><?php echo $row['descri_pro']; ?></p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Precio de Elaboraci??n: <?php echo $row['precio_elav']; ?></li>
              <li class="list-group-item">Precio de Venta: <?php echo $row['precio_venta']; ?></li>
              <li class="list-group-item">Cantidad: <?php echo $row['cantidad']; ?></li>
            </ul>
            <div class="card-footer">
              <!-- Boton de vista y edicion -->
              <a class="btn btn-secondary editar" 
                data-id='{"id_prod":"<?php echo $row['id_prod']?>","nom_pro":"<?php echo $row['nom_pro']?>","descri_pro":"<?php echo $row['descri_pro']?>","tipo":"<?php echo $row['tipo']?>","inactivo":"<?php echo $row['inactivo']?>","precio_elav":"<?php echo $row['precio_elav']?>","precio_venta":"<?php echo $row['precio_venta']?>","cantidad":"<?php echo $row['cantidad']?>"}' 
                data-bs-toggle="modal" 
                data-bs-target="#VentanaEmergenteVisualizar" 
                role="button"
              >Ver m??s</a>
              <!-- Boton de eliminacion -->
              <?php
              if ($row['inactivo'] == false) {
              echo "<a class=\"btn btn-danger eliminar\" 
                data-id=\"{$row['id_prod']}\"
                data-bs-toggle=\"modal\" 
                data-bs-target=\"#VentanaEmergenteConfirmacion\" 
                role=\"button\"
              >Eliminar</a>";
              }
              ?>
          </div>
          </div>
        </div>

      <?php } ?>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
<script src="js\desabilitar_inputs.js"></script>
<script src="js\pasar_datos_modal.js"></script>
<script src="js\filtrador_productos.js"></script>
<script src="js\vista_imagenes.js"></script>