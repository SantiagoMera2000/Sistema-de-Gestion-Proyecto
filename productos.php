<?php include("logic/conexion.php"); ?>

<?php include('includes/header.php'); ?>

<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location: login.php");
}
?>
<!-- Contenedor principal donde empaqueta todo -->
<main class="main col">
  <div class="row">
    <div class="col-md-4">
      <!-- Mensajes -->
      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>
      <div class="card-group">
          <?php
          $query = "SELECT * FROM producto";
          $result_tasks = mysqli_query($conexion, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <div class="card">
          <img src="img\<?php echo $row['img_id']?>" class="card-img-top" alt="<?php echo $row['nom_pro']; ?>" width="70px">
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
