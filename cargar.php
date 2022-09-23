<?php

include("logic/conexion.php");
session_start();

if (isset($_POST['cargar'])) {
  $nombre = $_POST['nombre'];
  $descr= $_POST['descr'];
  $tipo = $_POST['tipo'];
  #$estado = $_POST['estado'];
  $precio_elav = $_POST['precio_elav'];
  $precio_venta = $_POST['precio_venta'];
  $cantidad = $_POST['cantidad'];
  $nombrimagen = $_FILES['imagen']['name'];

  $ruta_indexphp = dirname(realpath(__FILE__));
  $ruta_fichero_origen = $_FILES['imagen']['tmp_name'];
  $ruta_nuevo_destino = $ruta_indexphp . '/img/' . $_FILES['imagen']['name'];
  move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino );
  
  #$query = "INSERT into producto values ('','$nombre','$descr','$tipo','0','$precio_elav','$precio_venta','$cantidad','$nombrimagen')";
  #$result = mysqli_query($conexion, $query);
  #if(!$result) {
   # die("Error en la Consulta.");
  #}

  #$_SESSION['message'] = 'Tarea creada correctamente';
  #$_SESSION['message_type'] = 'success';
  #header('location: productos.php');
  echo "$nombre, $descr, $tipo, estado, $precio_elav, $precio_venta, $cantidad, $nombrimagen";
}

?>
