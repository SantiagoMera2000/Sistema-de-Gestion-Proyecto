<?php

include("logic/conexion.php");
session_start();

if (isset($_POST['cargar'])) {
  #Variables donde se almacenan cada dato para su subida a la BD
  $nombre = $_POST['nombre'];
  $descr= $_POST['descr'];
  $tipo = $_POST['tipo'];
  #$estado = $_POST['estado'];
  $precio_elab = $_POST['precio_elab'];
  $precio_venta = $_POST['precio_venta'];
  $cantidad = $_POST['cantidad'];
  $nombrimagen = $_FILES['imagen']['name'];

  #Variables para obtener informacion relacionada al archivo de subida
  $ruta_indexphp = dirname(realpath(__FILE__));
  $ruta_fichero_origen = $_FILES['imagen']['tmp_name'];
  $ruta_nuevo_destino = $ruta_indexphp . '/img/producto/' . $_FILES['imagen']['name'];
  #Subida de archivos al servidor en el Apache
  move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino );
  
  #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
  $query = "INSERT into producto values ('','$nombre','$descr','$tipo','0','$precio_elab','$precio_venta','$cantidad','$nombrimagen')";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die("Error en la Consulta.");
  }

  #Regresa a la Pagina de los Productos
  header('location: productos.php');

  #Restos de pruebas y testing
  #$_SESSION['message'] = 'Tarea creada correctamente';
  #$_SESSION['message_type'] = 'success';
  #echo "$nombre, $descr, $tipo, estado, $precio_elab, $precio_venta, $cantidad, $nombrimagen";
}

?>