<?php include("logic/conexion.php"); ?>

<?php include('includes/header.php'); ?>

<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
  header("location: login.php");
}
$query = "SELECT recetas from permisos where id_pe=$usuario";
$result = mysqli_query($conexion, $query);
while($row=mysqli_fetch_assoc($result)){
  if($row['recetas'] == false){
    echo $row['recetas'];
    header("location: index.php");
  }
}
?>
<link rel="stylesheet" href="css\recetas.css">

<!-- Ventana emergente (Modal) -->
<div class="modal fade" id="VentanaEmergente" tabindex="-1" aria-labelledby="VentanaEmergenteLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="VentanaEmergente">Agregar receta nueva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Cuerpo de la Ventana -->
      <div class="modal-body">
        <!-- Formulario para cargar los datos en la BD -->
        <form class="formulario" enctype="multipart/form-data" action="process/cargar.php" method="POST" autocomplete="off">
          <!-- Nombre del de la receta (es el nombre que usara en el producto final) -->
          <label class="lblnombre" for="nombre">Nombre </label>
          <input class="inpnombre form-control" type="text" id="nombre" name="nombre" required>
          <!-- observacion de la receta para ayudar a gastronomia -->
          <label class="lbldesc" for="descr">Observaciones </label>
          <textarea class="inpdesc form-control" rows="2" cols="50" id="descr" name="descr"></textarea>
          <!-- Imagen de la receta -->
          <label class="lblimagen" for="imagen">Imagen </label>
          <input class="imagen form-control" name="imagen" type="file" id="imagen"/>
          <div class="vistaprevia img-fluid rounded" id="imagepreview"></div>
          <!-- Pasos de elaboracion -->
          <label class="lblela" for="ela">Pasos de elaboracion</label>
          <textarea class="inpela form-control" id="pasos" name="pasos" required></textarea>
          <!-- Agregar ingredientes -->
          <div class="conjunto">
            <label class="lbling" for="insumos">Ingredientes</label>
            <button type="button" class="btn btn-primary botonagregar" onclick="agregaringrediente()">
              <span class="material-symbols-outlined">add</span>
            </button>
            <button type="button" class="btn btn-primary botonagregar" onclick="quitaringrediente()">
              <span class="material-symbols-outlined">remove</span>
            </button>
          </div>
          <div class="conjunto2">
            <label class="form-check-label lblestado" for="estado">Visibilidad</label>
            <div class="form-check form-switch estado">
              <input class="form-check-input inestado" type="checkbox" role="switch" id="estado" name="estado">
            </div>
          </div>
          <select class="form-select seling" aria-label="Ingredientes" id="ing1" name="ing1">
            <option selected>Ninguno seleccionado</option>
            <?php
            $query = "SELECT id_insu,nom_insu FROM insumo ORDER BY inactivo,nom_insu ASC";
            $result_tasks = mysqli_query($conexion, $query);
            while($row = mysqli_fetch_assoc($result_tasks)) { ?>
              <option value="<?php echo $row['id_insu'] ?>"><?php echo $row['nom_insu'] ?></option>
            <?php } ?>
          </select>
          <input class="inping form-control" type="number" step=any id="canting1" name="canting1" min="0" placeholder="Ingrese la cantidad" required>
          <select class="form-select selingun" aria-label="Unidad de Medida" id="uni1" name="uni1">
            <option value="1" selected>l</option>
            <option value="2">ml</option>
            <option value="3">kg</option>
            <option value="4">gr</option>
            <option value="5">c.c.</option>
            <option value="6">pizca</option>
            <option value="7">cda</option>
            <option value="8">C/N</option>
            <option value="9">Taza</option>
          </select>
        </div>
          <!-- Pie de la ventana emergente -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="this.form.reset()">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="cargar" name="cargar" value="recetas" >Agregar</button>
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
        ¿Estás seguro de que desear eliminar ésta receta?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form enctype="multipart/form-data" action="process/eliminar.php" method="POST">
          <button type="submit" class="btn btn-danger" name="eliminar_rec" id="eliminar_rec" value="">Aceptar</button>
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
          <h5 class="card-title">Agregar una receta</h5>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#VentanaEmergente" onclick="limpiar()">
            <span class="material-symbols-outlined agrandar-icono">add</span>
          </button>
        </div>
      </div>
    </div>
          <?php
          $query = "SELECT * FROM receta ORDER BY inactivo,nom_r ASC";
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
              <h5 class="card-title"><?php echo $row['nom_r']; ?></h5>
              <hr>
              <?php
              if ($row['img_id'] == "") {
                echo "<span class=\"material-symbols-outlined agrandar-icono\">image_not_supported</span>";
              } else {
                echo "<img class=\"img-preview rounded card-img-top img-fluid\" src='data:img/jpg;base64, ".base64_encode($row['img_id'])."' alt=\"{$row['nom_r']}\">";
              }
              ?>
            </div>
            <div class="card-footer">
              <!-- Boton de edicion -->
              <a class="btn btn-secondary editar_receta" data-id="<?php echo $row['id_rec']?>" role="button" id="ver">Ver más</a>
              <!-- Boton de eliminacion -->
              <?php
              if ($row['inactivo'] == false) {
              echo "<a class=\"btn btn-danger eliminar_rec\" 
                data-id=\"{$row['id_rec']}\"
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
<script src="js\calculos_recetas.js"></script>
<script src="js\vista_imagenes.js"></script>
<script src="js\filtrador_productos.js"></script>