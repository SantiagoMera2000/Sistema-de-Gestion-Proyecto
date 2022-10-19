<?php

include("logic/conexion.php");
session_start();


if (isset($_POST['eliminar_prod'])) {
  $id = $_POST['eliminar_prod'];
  $query = "UPDATE producto SET inactivo = true WHERE id_prod = $id ";
  $result = mysqli_query($conexion, $query);

  header('Location: productos.php');
}
if (isset($_POST['eliminar_rec'])) {
    $id = $_POST['eliminar_rec'];
    echo "hola" ;
    $query = "UPDATE receta SET inactivo = true WHERE id_rec = $id ";
    $result = mysqli_query($conexion, $query);
  
    header('Location: recetas.php');
}
?>
