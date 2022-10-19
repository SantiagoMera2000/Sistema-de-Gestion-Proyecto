<?php include("logic/conexion.php"); ?>

<?php include('includes/header.php'); ?>

<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
  header("location: login.php");
}
?>
<link rel="stylesheet" href="css\insumo.css">

<!-- Ventana emergente (Modal) -->
<div class="modal fade" id="VentanaEmergente" tabindex="-1" aria-labelledby="VentanaEmergenteLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="VentanaEmergente">Agregar un Insumo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Cuerpo de la Ventana -->
      <div class="modal-body">
        <br>
        <!-- Formulario para cargar los datos en la BD -->
        <form class="formulario" enctype="multipart/form-data" action="cargar.php" method="POST">
          <!-- Imagen del Insumo -->
          <input class="imagen rounded form-control" name="imagen_insu" type="file" id="imagen_insu"/>
          <div class="vistaprevia rounded" id="imagepreview">
          </div>
          <!-- Nombre del Insumo -->
          <label class="lblnombre" for="nombre">Nombre </label>
          <input class="inpnombre" type="text" id="nom_insu" name="nom_insu">
          <!-- Precio de Insumo (Comida,Bebida,etc) -->
          <label class="lblprecio" for="precio">Precio </label>
          <input class="inpprecio" type="number" id="precio_insu" name="precio_insu" min=1>
          <!-- Estado del Producto (Visible) -->
          <label class="form-check-label lblestado" for="estado">Visible</label>
          <div class="form-check form-switch estado">
            <input class="form-check-input" type="checkbox" role="switch" id="estado">
          </div>
          <!-- Cantidad de Insumo -->
          <label class="lblcant" for="cant_disp">Cantidad </label>
          <input class="inpcant" type="number" id="cant_disp" name="cant_disp" min=1>
          <select class="ltunidades" name="unidad_insu" id="unidad_insu">
            <option value="1">Gramos</option>
            <option value="2">Kilogramos</option>
            <option value="3">Litros</option>
            <option value="4">Mililitros</option>
            <option value="5">Cantidad</option>
          </select>
          </div>
          <!-- Pie de la ventana emergente -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="cargar" name="cargar" value="insumo" >Agregar</button>
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
        ¿Estas seguro de que desear eliminar este insumo?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form enctype="multipart/form-data" action="eliminar.php" method="POST">
          <button type="submit" class="btn btn-danger" name="eliminar_insu" id="eliminar_insu" value="">Aceptar</button>
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
          $query = "SELECT * FROM insumo ORDER BY inactivo,nom_insu";
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
              <h5 class="card-title"><?php echo $row['nom_insu']; ?></h5>
              <hr>
              <?php
              if ($row['img_insu'] == "") {
                echo "<span class=\"material-symbols-outlined agrandar-icono\">image_not_supported</span>";
              } else {
                echo "<img class=\"img-preview card-img-top img-fluid\" src=\"img/insumo/{$row['img_insu']}\" alt=\"{$row['nom_insu']}\">";
              }
              ?>
            </div>
            <ul class="list-group list-group-flush">
              <?php 
              if ($row['unidad_insu'] == "1" ) {
                $unidad = " g";
              }elseif ($row['unidad_insu'] == "2" ) {
                $unidad = " kg";
              }elseif ($row['unidad_insu'] == "3" ) {
                $unidad = " L";
              }elseif ($row['unidad_insu'] == "4" ) {
                $unidad = " ml";
              }elseif ($row['unidad_insu'] == "5" ) {
                $unidad = " unidades";
              }
              ?>
              <li class="list-group-item">Cantidad: <?php echo $row['cant_disp']; echo $unidad; ?></li>
              <li class="list-group-item">Precio: <?php echo $row['precio_insu']; ?></li>
            </ul>
            <div class="card-footer">
              <!-- Boton de vista y edicion -->
              <a class="btn btn-secondary editar" 
                data-id='{"id_insu":"<?php echo $row['id_insu']?>","nom_insu":"<?php echo $row['nom_insu']?>","img_insu":"<?php echo $row['img_insu']?>","unidad_insu":"<?php echo $row['unidad_insu']?>","cant_disp":"<?php echo $row['cant_disp']?>","precio_insu":"<?php echo $row['precio_insu']?>""}' 
                data-bs-toggle="modal" 
                data-bs-target="#VentanaEmergenteVisualizar" 
                role="button"
              >Editar</a>
              <!-- Boton de eliminacion -->
              <?php
              if ($row['inactivo'] == false) {
              echo "<a class=\"btn btn-danger eliminar\" 
                data-id=\"{$row['id_insu']}\"
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
<script src="js\pasar_datos_modal.js"></script>
<script src="js\filtrador_productos.js"></script>