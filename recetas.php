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
        <form class="formulario" enctype="multipart/form-data" action="cargar.php" method="POST" autocomplete="off">
          <!-- Imagen del Producto -->
          <input class="imagen form-control" name="imagen" type="file" id="imagen"/>
          <div class="vistaprevia" id="imagepreview">
          </div>
          <!-- Nombre del Producto -->
          <label class="lblnombre" for="nombre">Nombre </label>
          <input class="inpnombre" type="text" id="nombre" name="nombre" required>
          <!-- Descripción del producto -->
          <label class="lbldesc" for="descr">Descripción </label>
          <textarea class="inpdesc" rows="2" cols="50" id="descr" name="descr"></textarea>
          <!-- Agregar ingredientes -->
          <div class="ui-widget">
            <label class="lbling" for="descr">Ingredientes </label>  
            <input class="autocompletar" name="1"/>
            <button type="button" class="btn btn-primary" onclick="agregaringrediente()">
              <span class="material-symbols-outlined">add</span>
            </button>
          </div>
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
        <form enctype="multipart/form-data" action="eliminar.php" method="POST">
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
              <img class="img-preview" src="img/receta/<?php echo $row['img_id']?>" class="card-img-top img-fluid" alt="<?php echo $row['nom_r']; ?>">
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
  var contador = 1;
  function agregaringrediente() {
    contador = contador+1;
    $('<label class="lbling" for="descr">Ingredientes </label><input class="autocompletar" name="2"><button type="button" class="btn btn-primary" onclick="agregaringrediente()"><span class="material-symbols-outlined">add</span></button>').appendTo('.ui-widget');
};
</script>