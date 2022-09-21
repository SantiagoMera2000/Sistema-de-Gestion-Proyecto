<?php

include("logic/conexion.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM task WHERE id = $id";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die("Error en la Consulta.");
  }

  $_SESSION['message'] = 'Tarea removida con exito';
  $_SESSION['message_type'] = 'danger';
  header('Location: index.php');
}

?>
