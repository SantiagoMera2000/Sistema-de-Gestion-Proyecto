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
  <div class="modal-dialog modal-xl modal-dialog-centered">
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
          <!-- Nombre del de la receta (es el nombre que usara en el producto final) -->
          <label class="lblnombre" for="nombre">Nombre </label>
          <input class="inpnombre" type="text" id="nombre" name="nombre" required>
          <!-- observacion de la receta para ayudar a gastronomia -->
          <label class="lbldesc" for="descr">Observaciones </label>
          <textarea class="inpdesc" rows="2" cols="50" id="descr" name="descr"></textarea>
          <!-- Imagen de la receta -->
          <label class="lblimagen" for="imagen">Imagen </label>
          <input class="imagen form-control" name="imagen" type="file" id="imagen"/>
          <div class="vistaprevia img-fluid rounded" id="imagepreview"></div>
          <!-- Pasos de elaboracion -->
          <div class="elaboracion">
            <label class="lblela" for="ela">Pasos de elaboracion</label>
            <button type="button" class="btn btn-primary botonagregar" onclick="agregarpaso()">
              <span class="material-symbols-outlined">add</span>
            </button>
            <button type="button" class="btn btn-primary botonagregar" onclick="quitarpaso()">
              <span class="material-symbols-outlined">remove</span>
            </button>
          </div>
          <input class="inpela" type="text" id="paso1" name="paso1" required>
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
          <select class="form-select selingun" aria-label="Unidad de Medida" id="uni1" name="uni1">
            <option value="1" selected>l</option>
            <option value="2">ml</option>
            <option value="3">kg</option>
            <option value="4">gr</option>
            <option value="5">c.c.</option>
            <option value="6">pizca</option>
            <option value="7">cda</option>
            <option value="8">C/N</option>
          </select>
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
                echo "<img class=\"img-preview rounded card-img-top img-fluid\" src=\"img/receta/{$row['img_id']}\" alt=\"{$row['nom_r']}\">";
              }
              ?>
              <hr>
              <p class="card-text"><?php echo $row['descri_r']; ?></p>
            </div>
            <div class="card-footer">
              <!-- Boton de edicion -->
              <a class="btn btn-secondary editar" 
                data-id='{"id_rec":"<?php echo $row['id_rec']?>","nom_r":"<?php echo $row['nom_r']?>","descri_r":"<?php echo $row['descri_r']?>","img_id":"<?php echo $row['img_id']?>"}' 
                data-bs-toggle="modal" 
                data-bs-target="#VentanaEmergenteVisualizar" 
                role="button"
              >Ver más</a>
              <!-- Boton de eliminacion -->
              <?php
              if ($row['inactivo'] == false) {
              echo "<a class=\"btn btn-danger eliminar\" 
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
  var pasonum = 1;
  var filapasoant = 2;
  var filapasosig = 3;

  var canting = 1;
  var filant = 2;
  var filasi = 3;
  function agregaringrediente() {
    canting = canting+1;
    filant = filant+1;
    filasi = filasi+1;
    $('#ing1').clone(true).prop({
      id: function (i, oldId) {return 'ing'+canting;},
      name: function (i, oldId) {return 'ing'+canting;},
      style: 'grid-column: 3/4; grid-row:'+filant+'/'+filasi+';'
    }).appendTo('.formulario');
    $('#canting1').clone(true).prop({
      id: function (i, oldId) {return 'canting'+canting;},
      name: function (i, oldId) {return 'canting'+canting;},
      style: 'grid-column: 4/5; grid-row:'+filant+'/'+filasi+';'
    }).appendTo('.formulario');
    $('#uni1').clone(true).prop({
      id: function (i, oldId) {return 'uni'+canting;},
      name: function (i, oldId) {return 'uni'+canting;},
      style: 'grid-column: 5/6; grid-row:'+filant+'/'+filasi+';'
    }).appendTo('.formulario');
};
function quitaringrediente() {
  if (canting >= "2") {
    $('#ing'+canting).remove();
    $('#canting'+canting).remove();
    $('#uni'+canting).remove();
    canting = canting-1;
    filant = filant-1;
    filasi = filasi-1;
  }
};


function agregarpaso() {
  pasonum = pasonum+1;
  filapasoant = filapasoant+1;
  filapasosig = filapasosig+1;
  $('#paso1').clone(true).prop({
    id: function (i, oldId) {return 'paso'+pasonum;},
    name: function (i, oldId) {return 'paso'+pasonum;},
    style: 'grid-column: 3/4; grid-row:'+filapasoant+'/'+filapasosig+';'
    }).appendTo('.formulario');
};
function quitarpaso(){
  if (pasonum >= "2") {
    $('#paso'+pasonum).remove();
    pasonum = pasonum-1;
    filapasoant = filapasoant-1;
    filapasosig = filapasosig-1;
  }
};

$('.seling').on('change', function(event ) {
  //restore previously selected value
  var prevValue = $(this).data('previous');
  $('.seling').not(this).find('option[value="'+prevValue+'"]').show();
  //hide option selected                
  var value = $(this).val();
  //update previously selected data
  $(this).data('previous',value);
  $('.seling').not(this).find('option[value="'+value+'"]').hide();
  });
</script>