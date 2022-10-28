<?php include("logic/conexion.php"); ?>

<?php include('includes/header.php'); ?>

<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
  header("location: login.php");
}
?>
<link rel="stylesheet" href="css\recetas.css">

<!-- Ventana emergente (Modal) -->
<div class="modal" id="VentanaEmergente" tabindex="-1" aria-labelledby="VentanaEmergenteLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="VentanaEmergente">Agregar receta nueva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Cuerpo de la Ventana -->
      <div class="modal-body">
        <br>
        <?php include('logic/conexion_insu.php');?>
        <!-- Formulario para cargar los datos en la BD -->
        <form class="formulario" enctype="multipart/form-data" action="process/cargar.php" method="POST" autocomplete="off">
          <!-- Imagen del Producto -->
          <input class="imagen form-control" name="imagen" type="file" id="imagen"/>
          <div class="vistaprevia img-fluid rounded" id="imagepreview"></div>
          <!-- Nombre del Producto -->
          <label class="lblnombre" for="nombre">Nombre </label>
          <input class="inpnombre" type="text" id="nombre" name="nombre" required>
          <!-- Descripción del producto -->
          <label class="lbldesc" for="descr">Descripción </label>
          <textarea class="inpdesc" rows="2" cols="50" id="descr" name="descr"></textarea>
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
          <input class="inping" type="number" id="canting1" name="canting1" min="0" placeholder="Ingrese la cantidad" required>
          <select class="form-select seling" aria-label="Ingredientes" id="ing1" name="ing1">
            <option selected>Ninguno seleccionado</option>
            <?php
            $query = "SELECT id_insu,nom_insu FROM insumo ORDER BY inactivo,nom_insu ASC";
            $result_tasks = mysqli_query($conexion, $query);
            while($row = mysqli_fetch_assoc($result_tasks)) { ?>
              <option value="<?php echo $row['id_insu'] ?>"><?php echo $row['nom_insu'] ?></option>
            <?php } ?>
          </select>
        </div>
          <!-- Pie de la ventana emergente -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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
          $query = "SELECT * FROM receta where estado = 1";
          $result_tasks = mysqli_query($conexion, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <!-- Tarjetas donde se cargan los datos de la BD -->
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nom_r']; ?></h5>
              <hr>
              <img class="img-preview img-fluid rounded" src="img/receta/<?php echo $row['img_id']?>" class="card-img-top img-fluid" alt="<?php echo $row['nom_r']; ?>">
              <hr>
              <p class="card-text"><?php echo $row['descri_r']; ?></p>
            </div>
            <div class="card-footer">
              <a href="edit.php?id=<?php echo $row['id_rec']?>" class="btn btn-secondary">
                <span class="material-symbols-outlined">edit</span>
              </a>
              <a class="btn btn-danger eliminar_rec" data-id="<?php echo $row['id_rec']?>" data-bs-toggle="modal" data-bs-target="#VentanaEmergenteConfirmacion">
                  <span class="material-symbols-outlined">delete</span>
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
<script>
//Insumos disponibles almacenados en un array
let insumosdisponibles = <?php echo $json_array; ?>;
$('.autocompletar').autocomplete({
    source: insumosdisponibles,
    select: function(event, ui) {
        console.log(event.target.name);
        console.log($(this).prop('name'));
        alert($(this).attr('name'));
    }
})
</script>
<script>
  var canting = 1;
  var filant = 4;
  var filasi = 5;
  function agregaringrediente() {
    canting = canting+1;
    filant = filant+1;
    filasi = filasi+1;
    $('#ing1').clone(true).prop({
      id: function (i, oldId) {return 'ing'+canting;},
      name: function (i, oldId) {return 'ing'+canting;},
      style: 'grid-column: 1/2; grid-row:'+filant+'/'+filasi+';'
    }).appendTo('.formulario');
    $('#canting1').clone(true).prop({
      id: function (i, oldId) {return 'canting'+canting;},
      name: function (i, oldId) {return 'canting'+canting;},
      style: 'grid-column: 2/3; grid-row:'+filant+'/'+filasi+';'
    }).appendTo('.formulario');
};
function quitaringrediente() {
  if (canting >= "2") {
    $('#ing'+canting).remove();
    $('#canting'+canting).remove();
    canting = canting-1;
    filant = filant-1;
    filasi = filasi-1;
  }
};
</script>