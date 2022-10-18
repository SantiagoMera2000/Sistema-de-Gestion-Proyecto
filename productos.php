<?php include("logic/conexion.php"); ?>

<?php include('includes/header.php'); ?>

<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
  header("location: login.php");
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
        <form id="form" class="formulario" enctype="multipart/form-data" action="cargar.php" method="POST">
          <!-- Imagen del Producto -->
          <input class="imagen rounded form-control" name="imagen" type="file" id="imagen"/>
          <div class="vistaprevia rounded" id="imagepreview">
          </div>
          <!-- Nombre del Producto -->
          <label class="lblnombre" for="nombre">Nombre </label>
          <input class="inpnombre" type="text" id="nombre" name="nombre">
          <!-- Descripción del producto -->
          <label class="lbldesc" for="descr">Descripción </label>
          <input class="impdesc" type="text" id="descr" name="descr">
          <!-- Tipo del Producto (Comida,Bebida,etc) -->
          <label class="lbltipo" for="tipo">Tipo </label>
          <input class="inptipo" type="text" id="tipo" name="tipo">
          <!-- Precio de Elaboracion -->
          <label class="lblelab" for="precio_elab">Precio de elaboración($)</label>
          <input class="inpelab" type="number" id="precio_elab" name="precio_elab">
          <!-- Precio de Venta -->
          <label class="lblventa" for="precio_venta">Precio de venta ($) </label>
          <input class="inpventa" type="number" id="precio_venta" name="precio_venta">
          <!-- Cantidad de Productos -->
          <label class="lblcant" for="cantidad">Cantidad </label>
          <input class="inpcant" type="text" id="cantidad" name="cantidad" min="1">
          <!-- Estado del Producto (Visible) -->
          <label class="form-check-label lblestado" for="estado">Visibilidad</label>
          <div class="form-check form-switch estado">
            <input class="form-check-input" type="checkbox" role="switch" id="estado">
          </div>
        </div>
          <!-- Pie de la ventana emergente -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cancelar" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="cargar" name="cargar" value="producto" >Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- Ventana emergente Visualizar producto -->
<div class="modal fade" id="VentanaEmergenteVisualizar" data-bs-backdrop="static" tabindex="-1" aria-labelledby="VentanaEmergenteVisualizar" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="VentanaEmergenteVisualizar">Ver un Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Cuerpo de la Ventana -->
      <div class="modal-body">
        <br>
        <!-- Formulario para cargar los datos en la BD -->
        <form id="form" class="formulario" enctype="multipart/form-data" action="cargar.php" method="POST">
          <!-- Imagen del Producto -->
          <input class="imagen rounded form-control" name="imagen" type="file" id="imagen"/>
          <div class="vistaprevia rounded" id="imagepreview">
            <img src='"img/producto/<?php echo $row['img_id']?>"' class='img-fluid rounded'/>
          </div>
          <!-- Nombre del Producto -->
          <label class="lblnombre" for="nombre">Nombre </label>
          <input class="inpnombre" type="text" id="nombre" name="nombre" value="">
          <!-- Descripción del producto -->
          <label class="lbldesc" for="descr">Descripción </label>
          <input class="impdesc" type="text" id="descr" name="descr" value="">
          <!-- Tipo del Producto (Comida,Bebida,etc) -->
          <label class="lbltipo" for="tipo">Tipo </label>
          <input class="inptipo" type="text" id="tipo" name="tipo" value="">
          <!-- Precio de Elaboracion -->
          <label class="lblelab" for="precio_elab">Precio de Elaboración </label>
          <input class="inpelab" type="number" id="precio_elab" name="precio_elab" min=1 value="">
          <!-- Precio de Venta -->
          <label class="lblventa" for="precio_venta">Precio de Venta </label>
          <input class="inpventa" type="number" id="precio_venta" name="precio_venta" min=1 value="">
          <!-- Cantidad de Productos -->
          <label class="lblcant" for="cantidad">Cantidad </label>
          <input class="inpcant" type="text" id="cantidad" name="cantidad" min="1" value="">
          <!-- Estado del Producto (Visible) -->
          <label class="form-check-label lblestado" for="estado">Visibilidad</label>
          <div class="form-check form-switch estado">
            <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado">
          </div>
        </div>
          <!-- Pie de la ventana emergente -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cancelar1" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="cargar" name="cargar" value="productoeditar" >Completar edición</button>
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
        <h1 class="modal-title fs-5" id="VentanaEmergenteConfirmacion">Confirmar Eliminación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estas seguro de que desear eliminar este producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form enctype="multipart/form-data" action="eliminar.php" method="POST">
          <button type="submit" class="btn btn-danger" name="eliminar_prod" id="eliminar_prod" value="">Aceptar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Contenedor principal -->
<main class="main">
  <div class="row row-cols-1 row-cols-md-6 g-4">
    <div class="col agregar">
      <!-- Tarjeta para agregar los productos (Llama a la ventana emergente) -->
      <div class="ajustes">
        <div class="card-body">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#VentanaEmergente">
            <span class="material-symbols-outlined agrandar-icono">add</span>
          </button>
        </div>
      </div>
    </div>
          <?php
          $query = "SELECT * FROM producto WHERE estado = 1";
          $result_tasks = mysqli_query($conexion, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <!-- Tarjetas donde se cargan los datos de la BD -->
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nom_pro']; ?></h5>
              <hr>
              <img class="img-preview rounded" src="img/producto/<?php echo $row['img_id']?>" class="card-img-top img-fluid" alt="<?php echo $row['nom_pro']; ?>">
              <hr>
              <p class="card-text"><?php echo $row['descri_pro']; ?></p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Precio de Elaboración: <?php echo $row['precio_elav']; ?></li>
              <li class="list-group-item">Precio de Venta: <?php echo $row['precio_venta']; ?></li>
              <li class="list-group-item">Disponibles: <?php echo $row['cantidad']; ?></li>
            </ul>
            <div class="card-footer">
            <a class="btn btn-secondary editar" data-id='{"id_prod":"<?php echo $row['id_prod']?>","nom_pro":"<?php echo $row['nom_pro']?>","descri_pro":"<?php echo $row['descri_pro']?>","tipo":"<?php echo $row['tipo']?>","precio_elav":"<?php echo $row['precio_elav']?>","precio_venta":"<?php echo $row['precio_venta']?>","cantidad":"<?php echo $row['cantidad']?>","imagen":"<?php echo $row['img_id']?>"}' data-bs-toggle="modal" data-bs-target="#VentanaEmergenteVisualizar" role="button">
                  Ver más
              </a>
              <a class="btn btn-danger eliminar" data-id="<?php echo $row['id_prod']?>" data-bs-toggle="modal" data-bs-target="#VentanaEmergenteConfirmacion" role="button">
                Eliminar
            </a>
          </div>
          </div>
        </div>

      <?php } ?>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
<script src="js\pasar_datos_modal.js"></script>
<script src="js\limpiar_inputs.js"></script>