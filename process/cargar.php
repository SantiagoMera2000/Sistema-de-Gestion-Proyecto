<?php

include("../logic/conexion.php");
session_start();

if (isset($_POST['cargar'])) {
  if ($_POST['cargar'] == "producto" ) {
  #Variables donde se almacenan cada dato para su subida a la BD
  $nombre = $_POST['receta'];
  $descr= $_POST['descr'];
  $tipo = $_POST['tipo'];
  $precio_elab = $_POST['precio_elab'];
  $precio_venta = $_POST['precio_venta'];
  $cantidad = $_POST['cantidad'];
  $nombrimagen = $_FILES['imagen']['name'];

  #Verificamos el estado del switch de visibilidad
  if($_POST['estado'] == "on") {
    $estado = false;
  } else {
    $estado = true;
  }

  #Variables para obtener informacion relacionada al archivo de subida
  $ruta_indexphp = dirname(realpath(__FILE__));
  $ruta_fichero_origen = $_FILES['imagen']['tmp_name'];
  $ruta_nuevo_destino = $ruta_indexphp . '../img/producto/' . $_FILES['imagen']['name'];
  #Subida de archivos al servidor en el Apache
  move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino );
  
  #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
  $query = "INSERT into producto values ('0','$nombre','$descr','$tipo','$estado','$precio_elab','$precio_venta','$cantidad','$nombrimagen')";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die("Error en la Consulta.");
  }

  #Regresa a la Pagina de los Productos
  header('location: ../productos.php');

  } elseif ( $_POST['cargar'] == "insumo") {
    $nombre = $_POST['nom_insu'];
    $cantidad = $_POST['cant_disp'];
    $unidad = $_POST['unidad_insu'];
    $precio = $_POST['precio_insu'];
    $nombrimagen = $_FILES['imagen_insu']['name'];

    #Verificamos el estado del switch de visibilidad
    if($_POST['estado'] == "on") {
      $estado = false;
    } else {
      $estado = true;
    }

    #Variables para obtener informacion relacionada al archivo de subida
    $ruta_indexphp = dirname(realpath(__FILE__));
    $ruta_fichero_origen = $_FILES['imagen_insu']['tmp_name'];
    $ruta_nuevo_destino = $ruta_indexphp . '../img/insumo/' . $_FILES['imagen_insu']['name'];
    #Subida de archivos al servidor en el Apache
    move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino );
  
    #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
    $query = "INSERT into insumo values ('0','$nombre','$cantidad','$unidad','$precio','$nombrimagen','$estado')";
    $result = mysqli_query($conexion, $query);
    if(!$result) {
      die("Error en la Consulta.");
    }

    #Regresa a la Pagina de los Productos
    header('location: ../insumos.php');

  }  elseif ( $_POST['cargar'] == "recetas") {
    $nombre = $_POST['nombre'];
    $descripcion= $_POST['descr'];
    $pasos = $_POST['pasos'];
    $nombrimagen = $_FILES['imagen']['name'];

    #Variables para obtener informacion relacionada al archivo de subida
    $ruta_indexphp = dirname(realpath(__FILE__));
    $ruta_fichero_origen = $_FILES['imagen']['tmp_name'];
    $ruta_nuevo_destino = $ruta_indexphp . '../img/receta/' . $_FILES['imagen']['name'];
    #Subida de archivos al servidor en el Apache
    move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino );
  
    #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
    $query = "INSERT into receta values ('0','$nombre','$descripcion','$pasos','$nombrimagen', 'false')";
    $result = mysqli_query($conexion, $query);
    if(!$result) {
      die("Error en la Consulta.");
    }
    
    #Obtenemos el ID de la receta recien creada
    $query = mysqli_query($conexion, "SELECT id_rec FROM receta WHERE nom_r='$nombre'");
    $result = mysqli_fetch_assoc($query);
    $idrec = $result['id_rec'];
    
    #Agregamos los ingredientes de la receta uno a uno
    $contador = 1;
    $ing = "ing".$contador;
    while (isset($_POST["$ing"])) {
      $uni = "uni".$contador;
      $cant = "canting".$contador;
      $unidad = $_POST["$uni"];
      $cantidad = $_POST["$cant"];
      $idins = $_POST["$ing"];
      $query = "INSERT INTO contiene VALUES ('$idrec','$idins','$unidad','$cantidad')";
      mysqli_query($conexion, $query);
      $contador = $contador+1;
      $ing = "ing".$contador;
    }

    #Regresa a la Pagina de los Productos
    header('location: ../recetas.php');
    
    #Carga datos de usuarios
  }  elseif ( $_POST['cargar'] == "usuario") {
    $nombre = $_POST['nom_usu'];
    $apellido= $_POST['ape_usu'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    if($_POST['estado'] == "on") {
      $estado = true;
    } else {
      $estado = false;
    }
    $query = "INSERT into persona values ('0','$nombre','$apellido','$email','$clave', '$estado')";
    $result = mysqli_query($conexion, $query);

    $query = mysqli_query($conexion, "SELECT id FROM persona WHERE email='$email'");
    $result = mysqli_fetch_assoc($query);
    $id = $result['id'];

    if($_POST['permiso_insu'] == "on") {
      $Permiso_insu = true;
    } else {
      $Permiso_insu = false;
    }
    if($_POST['permiso_rec'] == "on") {
      $permiso_rec = true;
    } else {
      $permiso_rec = false;
    }
    if($_POST['permiso_prod'] == "on") {
      $permiso_prod = true;
    } else {
      $permiso_prod = false;
    }
    if($_POST['permiso_orden'] == "on") {
      $permiso_orden = true;
    } else {
      $permiso_orden = false;
    }
    if($_POST['permiso_facturacion'] == "on") {
      $permiso_facturacion = true;
    } else {
      $permiso_facturacion = false;
    }
    if($_POST['permiso_admin'] == "on") {
      $permiso_admin = true;
    } else {
      $permiso_admin = false;
    }
    $query = "INSERT into permisos values ('$id','$Permiso_insu','$permiso_rec ','$permiso_prod','$permiso_orden', '$permiso_facturacion','$permiso_admin')";
    $result = mysqli_query($conexion, $query);
    header('location: ../admin.php');
   
  }
  #Restos de pruebas y testing
  #$_SESSION['message'] = 'Tarea creada correctamente';
  #$_SESSION['message_type'] = 'success';
  #echo "$nombre, $descr, $tipo, estado, $precio_elab, $precio_venta, $cantidad, $nombrimagen";
} 

?>