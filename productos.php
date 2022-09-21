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

      <!-- Formulario de agregar tarea -->
      <div class="card card-body">
        <form action="save_task.php" method="POST">
          <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Nombre de la tarea" autofocus>
          </div>
          <div class="form-group">
            <textarea name="description" rows="2" class="form-control" placeholder="Descripción de la tarea"></textarea>
          </div>
          <input type="submit" name="save_task" class="btn btn-success btn-block" value="Guardar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Titulo</th>
            <th>Descripción</th>
            <th>Creado el</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM task";
          $result_tasks = mysqli_query($conexion, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
              <span class="material-symbols-outlined">edit</span>
              </a>
              <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
              <span class="material-symbols-outlined">delete</span>
              </a>
            </td>
          </tr>
        <?php 
        } 
        ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
