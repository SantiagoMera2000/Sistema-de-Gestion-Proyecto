<?php include("logic/conexion.php"); ?>

<?php include('includes/header.php'); ?>

<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location: login.php");
}
?>
<link rel="stylesheet" href="css\main1.css">
<link rel="stylesheet" href="css\productos.css">
<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar un Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="cargar.php" method="POST">
          <label for="nombre">Nombre de Producto:</label>
          <input type="text" id="nombre" name="nombre"><br>
          <label for="imagen">Imagen del Producto:</label>
          <input name="imagen" type="file" id="imagen"/><br>
          <label for="descr">Descripción</label>
          <input type="text" id="descr" name="descr"><br>
          <label for="tipo">Tipo:</label>
          <input type="text" id="tipo" name="tipo"><br>
          <div class="form-check form-switch">
            <label class="form-check-label" for="estado">Visible</label>
            <input class="form-check-input" type="checkbox" role="switch" id="estado">
          </div>
          <label for="precio_elav">Precio de Elaboración:</label>
          <input type="number" id="precio_elav" name="precio_elav"><br>
          <label for="precio_venta">Precio de Venta:</label>
          <input type="number" id="precio_venta" name="precio_venta"><br>
          <label for="cantidad">Cantidad:</label>
          <input type="text" id="cantidad" name="cantidad"><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" name="cargar">Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Contenedor principal donde empaqueta todo -->
<main class="main col">
  <div class="row">
    <div class="col-md-4">
      <div class="card-group">
        <div class="card text-center ajustes">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <span class="material-symbols-outlined agrandar-icono">add</span>
          </button>
        </div>
          <?php
          $query = "SELECT * FROM producto";
          $result_tasks = mysqli_query($conexion, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nom_pro']; ?></h5>
              <img src="img/producto/<?php echo $row['img_id']?>" class="card-img-top img-fluid" alt="<?php echo $row['nom_pro']; ?>">
              <p class="card-text"><?php echo $row['descri_pro']; ?></p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Disponibles:<?php echo $row['cantidad']; ?></li>
              <li class="list-group-item">Precio de Elaboración: <?php echo $row['precio_elav']; ?></li>
              <li class="list-group-item">Precio de Venta: <?php echo $row['precio_venta']; ?></li>
            </ul>
            <div class="card-body">
              <a href="edit.php?id=<?php echo $row['id_prod']?>" class="btn btn-secondary">
                <span class="material-symbols-outlined">edit</span>
              </a>
              <a href="delete_task.php?id=<?php echo $row['id_prod']?>" class="btn btn-danger">
                <span class="material-symbols-outlined">delete</span>
              </a>
          </div>
        </div>
      </div>
    <?php 
  } 
?>
      </div>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
