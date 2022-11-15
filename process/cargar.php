<?php
header('Content-Type: application/json');
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

  #Verificamos el estado del switch de visibilidad
  if($_POST['estado'] == "on") {
    $estado = false;
  } else {
    $estado = true;
  }

  #Verifica si se agregó una imagen y la guarda como binario para su subida
  if(!$_FILES['imagen']['name'] == ""){
    $tamano = $_FILES['imagen']['size'];
    $imgContenido = fopen($_FILES['imagen']['tmp_name'], 'r');
    $binarioimagen = fread($imgContenido, $tamano);
    $imgContenido = mysqli_escape_string($conexion, $binarioimagen);
  }else{
    $imgContenido = "";
  }
  
  #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
  $query = "INSERT into producto values ('0','$nombre','$descr','$tipo','$estado','$precio_elab','$precio_venta','$cantidad','$imgContenido')";
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

    #Verificamos el estado del switch de visibilidad
    if($_POST['estado'] == "on") {
      $estado = false;
    } else {
      $estado = true;
    }

    #Verifica si se agregó una imagen y la guarda como binario para su subida
    if(!$_FILES['imagen']['name'] == ""){
      $tamano = $_FILES['imagen']['size'];
      $imgContenido = fopen($_FILES['imagen']['tmp_name'], 'r');
      $binarioimagen = fread($imgContenido, $tamano);
      $imgContenido = mysqli_escape_string($conexion, $binarioimagen);
    }else{
      $imgContenido = "";
    }
  
    #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
    $query = "INSERT into insumo values ('0','$nombre','$cantidad','$unidad','$precio','$imgContenido','$estado')";
    $result = mysqli_query($conexion, $query);
    if(!$result) {
      die("Error en la Consulta.");
    }

    #Regresa a la Pagina de los Insumos
    header('location: ../insumos.php');

  }  elseif ( $_POST['cargar'] == "recetas") {
    $nombre = $_POST['nombre'];
    $descripcion= $_POST['descr'];
    $pasos = $_POST['pasos'];

    if($_POST['estado'] == "on") {
      $estado = false;
    } else {
      $estado = true;
    }

    #Verifica si se agregó una imagen y la guarda como binario para su subida
    if(!$_FILES['imagen']['name'] == ""){
      $tamano = $_FILES['imagen']['size'];
      $imgContenido = fopen($_FILES['imagen']['tmp_name'], 'r');
      $binarioimagen = fread($imgContenido, $tamano);
      $imgContenido = mysqli_escape_string($conexion, $binarioimagen);
    }else{
      $imgContenido = "";
    }
  
    #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
    $query = "INSERT into receta values ('0','$nombre','$descripcion','$pasos','$imgContenido', '$estado')";
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

    #Regresa a la Pagina de las recetas
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
} 
if ($_GET['cargar'] == "apfactura") {
  //Recuperamos el precio del producto
  $respuesta = mysqli_query($conexion, "select precio_venta from producto where id_prod=".$_POST['codigoproducto']);
  $reg=mysqli_fetch_array($respuesta);

  $codigofact = $_GET['codigofactura'];
  $codigoprod = $_POST['codigoproducto'];
  $precio = $reg['precio_venta'];
  $cantidad = $_POST['cantidad'];

  $respuesta = mysqli_query($conexion, "insert into detallefactura values ('0','$codigofact','$codigoprod','$precio','$cantidad','false')");
  echo json_encode($respuesta);
}
?>