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
        <h5 class="modal-title" id="VentanaEmergente">Agregar un Insumo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Cuerpo de la Ventana -->
      <div class="modal-body">
        <br>
        <!-- Formulario para cargar los datos en la BD -->
        <form class="formulario" enctype="multipart/form-data" action="cargar.php" method="POST">
          <!-- Imagen del Insumo -->
          <input class="imagen" name="imagen" type="file" id="imagen"/>
          <div class="vistaprevia" id="imagepreview">
          </div>
          <!-- Nombre del Insumo -->
          <label class="lblnombre" for="nombre">Nombre </label>
          <input class="inpnombre" type="text" id="nombre" name="nombre">
          <!-- Precio de Insumo (Comida,Bebida,etc) -->
          <label class="lbltipo" for="tipo">Tipo </label>
          <input class="inptipo" type="text" id="tipo" name="tipo">
          <!-- Estado del Producto (Visible) -->
          <div class="form-check form-switch estado">
            <label class="form-check-label" for="estado">Visible</label>
            <input class="form-check-input" type="checkbox" role="switch" id="estado">
          </div>
          <!-- Cantidad de Insumo -->
          <label class="lblcant" for="cantidad">Cantidad </label>
          <input class="inpcant" type="text" id="cantidad" name="cantidad">
          </div>
          <!-- Pie de la ventana emergente -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="cargar">Agregar</button>
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
        ¿Estas seguro de que desear eliminar este producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="eliminar.php?id=<?php echo $_POST['eliminar']?>" class="btn btn-danger">Aceptar</a>
        <button type="button" class="btn btn-danger">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Contenedor principal -->
<main class="main">
  <div class="row row-cols-1 row-cols-md-6 g-4">
    <div class="col agregar">
      <!-- Tarjeta para agregar los productos (Llama a la ventana emergente) -->
      <div class="card ajustes">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#VentanaEmergente">
          <span class="material-symbols-outlined agrandar-icono">add</span>
        </button>
      </div>
    </div>
          <?php
          $query = "SELECT * FROM insumo";
          $result_tasks = mysqli_query($conexion, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <!-- Tarjetas donde se cargan los datos de la BD -->
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nom_insu']; ?></h5>
              <hr>
              <img class="img-preview" src="img/insu<?php echo $row['img_insu']?>" class="card-img-top img-fluid" alt="<?php echo $row['nom_insu']; ?>">
              <hr>
              <!--<p class="card-text"><<?php echo $row['descri_pro'];?>/p>-->
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Cantidad de Insumo:<?php echo $row['cant_dispo']; ?></li>
              <li class="list-group-item">Precio del Insumo: <?php echo $row['precio_insu']; ?></li>
            </ul>
            <div class="card-footer">
              <?php $eliminar = $row['id_prod']; ?>
              <a href="edit.php?id=<?php echo $row['id_prod']?>" class="btn btn-secondary">
                <span class="material-symbols-outlined">edit</span>
              </a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#VentanaEmergenteConfirmacion">
                  <span class="material-symbols-outlined">delete</span>
                </button>
              <!--
              <a href="eliminar.php?id=<?php echo $row['id_prod']?>" class="btn btn-danger">
                <span class="material-symbols-outlined">delete</span>
              </a>
              -->
          </div>
          </div>
        </div>

      <?php } ?>
    </div>
  </div>
</main>

<script>
  $(document).on("click", ".open-AddBookDialog", function () {
  var myBookId = $(this).data('id');
  $(".modal-body #bookId").val( myBookId );
    // As pointed out in comments, 
    // it is unnecessary to have to manually call the modal.
    // $('#addBookDialog').modal('show');
});
</script>
<?php include('includes/footer.php'); ?>
