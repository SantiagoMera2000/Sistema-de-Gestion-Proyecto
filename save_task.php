<?php

include("logic/conexion.php");

if (isset($_POST['save_task'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $query = "INSERT INTO task(title, description) VALUES ('$title', '$description')";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die("Error en la Consulta.");
  }

  $_SESSION['message'] = 'Tarea creada correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: productos.php');

}

?>
