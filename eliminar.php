<?php

include("logic/conexion.php");
session_start();

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM producto WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("No se pudo eliminar.");
  }

  header('Location: productos.php');
}

?>
