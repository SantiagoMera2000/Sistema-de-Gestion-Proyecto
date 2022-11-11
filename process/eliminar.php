<?php

include("../logic/conexion.php");
session_start();


if (isset($_POST['eliminar_prod'])) {
  $id = $_POST['eliminar_prod'];
  $query = "UPDATE producto SET inactivo = true WHERE id_prod = $id ";
  $result = mysqli_query($conexion, $query);

  header('Location: ../productos.php');
}
if (isset($_POST['eliminar_rec'])) {
  $id = $_POST['eliminar_rec'];
  $query = "UPDATE receta SET inactivo = true WHERE id_rec = $id ";
  $result = mysqli_query($conexion, $query);
  
  header('Location: ../recetas.php');
}
if (isset($_POST['eliminar_insu'])) {
  $id = $_POST['eliminar_insu'];
  $query = "UPDATE insumo SET inactivo = true WHERE id_insu = $id ";
  $result = mysqli_query($conexion, $query);

  header('Location: ../insumos.php');
}
if (isset($_POST['eliminar_usu'])) {
  $id = $_POST['eliminar_usu'];
  $query = "UPDATE persona SET inactivo = true WHERE id = $id ";
  $result = mysqli_query($conexion, $query);

  header('Location: ../admin.php');
}
if (isset($_POST['eliminar_fact'])) {
  $id = $_POST['eliminar_fact'];
  mysqli_query($conexion, "UPDATE facturas SET descartada = true, fecha = CURDATE() WHERE codigo = $id");
  mysqli_query($conexion, "UPDATE detallefactura SET descartada = true WHERE codigofactura = $id");

  header('Location: ../facturacion.php');
}
if (isset($_GET['eliminar_fact'])) {
  $id = $_GET['eliminar_fact'];
  mysqli_query($conexion, "UPDATE facturas SET descartada = true, fecha = CURDATE() WHERE codigo = $id");
  mysqli_query($conexion, "UPDATE detallefactura SET descartada = true WHERE codigofactura = $id");

  header('Location: ../facturacion.php');
}

?>
