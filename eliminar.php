<?php

include("logic/conexion.php");
session_start();


if (isset($_POST['eliminar_prod'])) {
  $id = $_POST['eliminar_prod'];
  $query = "UPDATE producto SET estado = '0' WHERE id_prod = $id ";
  $result = mysqli_query($conexion, $query);

  header('Location: productos.php');
}
if (isset($_POST['eliminar_rec'])) {
    $id1 = $_POST['eliminar_rec'];
    echo "hola" ;
    $query = "UPDATE receta SET estado = '0' WHERE id_rec = $id1 ";
    $result = mysqli_query($conexion, $query);
  
    header('Location: recetas.php');
}
?>
