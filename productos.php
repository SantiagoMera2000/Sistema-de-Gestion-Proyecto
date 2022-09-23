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
<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
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
            <img src="img\<?php echo $row['img_id']?>" class="card-img-top" alt="<?php echo $row['nom_pro']; ?>" width="20px">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nom_pro']; ?></h5>
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
