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
<div class="modal" id="VentanaEmergente" tabindex="-1" aria-labelledby="VentanaEmergenteLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="VentanaEmergente">Agregar un Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Cuerpo de la Ventana -->
      <div class="modal-body">
        <br>
        <!-- Formulario para cargar los datos en la BD -->
        <form class="formulario" enctype="multipart/form-data" action="cargar.php" method="POST">
          <!-- Imagen del Producto -->
          <input class="imagen" name="imagen" type="file" id="imagen"/>
          <div class="vistaprevia" id="imagepreview">
          </div>
          <!-- Nombre del Producto -->
          <label class="lblnombre" for="nombre">Nombre </label>
          <input class="inpnombre" type="text" id="nombre" name="nombre">
          <!-- Descripción del producto -->
          <label class="lbldesc" for="descr">Descripción </label>
          <textarea class="inpdesc" rows="10" cols="50" id="descr" name="descr"></textarea>
          <!-- Agregar ingredientes -->
          <label class="lbling" for="descr">Ingredientes </label>  
          <select class="form-select seling" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
        </select>
        </div>
          <!-- Pie de la ventana emergente -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="cargar" name="cargar" value="producto" >Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- Ventana Modal de Confirmacion -->
<div class="modal fade" id="VentanaEmergenteConfirmacion" tabindex="-1" aria-labelledby="VentanaEmergenteConfirmacion" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
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
          $query = "SELECT * FROM receta";
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
              <a class="btn btn-danger eliminar" data-id="<?php echo $row['id_rec']?>" data-bs-toggle="modal" data-bs-target="#VentanaEmergenteConfirmacion">
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
<script>
  $(document).on("click", ".eliminar", function () {
  var IdProducto = $(this).data('id');
  $(".modal-footer #eliminar_prod").val( IdProducto );
});
</script>