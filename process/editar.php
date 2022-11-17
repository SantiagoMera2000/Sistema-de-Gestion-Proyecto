<?php

include("../logic/conexion.php");
session_start();

if (isset($_POST['editar'])) {
    if ($_POST['editar'] == "producto" ) {
    #Variables donde se almacenan cada dato para su subida a la BD
    $id = $_POST['id_prod'];
    $nombre_new = $_POST['nombreE'];
    $descr_new = $_POST['descrE'];
    $tipo_new = $_POST['tipoE'];
    $precio_elab_new = $_POST['precio_elabE'];
    $precio_venta_new = $_POST['precio_ventaE'];
    $cantidad_new = $_POST['cantidadE'];

    #Verificamos el estado del switch de visibilidad
    if($_POST['estadoE'] == "on") {
        $estado_new = false;
    } else {
        $estado_new = true;
    }

    #Variables para obtener informacion relacionada al archivo de subida
    if(!$_FILES['imagenE']['name'] == ""){
        $tamano = $_FILES['imagenE']['size'];
        $imgContenido = fopen($_FILES['imagenE']['tmp_name'], 'r');
        $binarioimagen = fread($imgContenido, $tamano);
        $nombrimagen_new = mysqli_escape_string($conexion, $binarioimagen);
    }else{
        $nombrimagen_new = "";
    }

    $datos_bd = "SELECT * FROM producto WHERE id_prod = $id";
    $result_tasks = mysqli_query($conexion, $datos_bd);    
    while($row = mysqli_fetch_assoc($result_tasks)) {
        $nombre_old = $row['nom_pro'];
        $descr_old = $row['descri_pro'];
        $tipo_old = $row['tipo'];
        $estado_old = $row['inactivo'];
        $precio_elab_old = $row['precio_elav'];
        $precio_venta_old = $row['precio_venta'];
        $cantidad_old = $row['cantidad'];
        $nombrimagen_old = $row['img_id'];
    }

    if ($nombre_new != $nombre_old) {
        $nombre = $nombre_new;
    }else {
        $nombre = $nombre_old;
    }
    if ($descr_new != $descr_old) {
        $descr = $descr_new;
    } else {
        $descr = $descr_old;
    }
    if ($tipo_new != $tipo_old) {
        $tipo = $tipo_new;
    } else {
        $tipo = $tipo_old;
    }
    if ($estado_new != $estado_old) {
        $estado = $estado_new;
    } else {
        $estado = $estado_old;
    }
    if ($precio_elab_new != $precio_elab_old) {
        $precio_elab = $precio_elab_new;
    } else {
        $precio_elab = $precio_elab_old;
    }
    if ($precio_venta_new != $precio_venta_old) {
        $precio_venta = $precio_venta_new;
    } else {
        $precio_venta = $precio_venta_old;
    }
    if ($cantidad_new != $cantidad_old) {
        $cantidad = $cantidad_new;
    } else {
        $cantidad = $cantidad_old;
    }
    if ("$nombrimagen_new" == "") {
        $imgContenido = "$nombrimagen_old";
    } else {
        $imgContenido = "$nombrimagen_new";
    }


    #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
    $query = "UPDATE producto SET nom_pro = \"$nombre\", descri_pro = \"$descr\", tipo = \"$tipo\", inactivo = \"$estado\", precio_elav = \"$precio_elab\", precio_venta = \"$precio_venta\", cantidad = \"$cantidad\", img_id = \"$imgContenido\" WHERE id_prod = \"$id\"";
    $result = mysqli_query($conexion, $query);
    if(!$result) {
        die("Error en la Consulta.");
    }
    #Regresa a la Pagina de los Productos
    header('location: ../productos.php');

    } elseif ($_POST['editar'] == "insumo" ) {
        #Variables donde se almacenan cada dato para su subida a la BD
        $id = $_POST['id_insu'];
        $nombre_new = $_POST['nom_insuE'];
        $precio_new = $_POST['precio_insuE'];
        $unidad_new = $_POST['unidad_insuE'];
        $cantidad_new = $_POST['cant_dispE'];
        $estado_new = $_POST['estadoE'];
    
        #Verificamos el estado del switch de visibilidad
        if($_POST['estadoE'] == "on") {
            $estado_new = true;
        } else {
            $estado_new = false;
        }
    
        #Variables para obtener informacion relacionada al archivo de subida
        if(!$_FILES['imagenE']['name'] == ""){
            $tamano = $_FILES['imagenE']['size'];
            $imgContenido = fopen($_FILES['imagenE']['tmp_name'], 'r');
            $binarioimagen = fread($imgContenido, $tamano);
            $nombrimagen_new = mysqli_escape_string($conexion, $binarioimagen);
        }else{
            $nombrimagen_new = "";
        }
    
        $datos_bd = "SELECT * FROM insumo WHERE id_insu = $id";
        $result_tasks = mysqli_query($conexion, $datos_bd);    
        while($row = mysqli_fetch_assoc($result_tasks)) {
            $nombre_old = $row['nom_insu'];
            $precio_old = $row['precio_insu'];
            $unidad_old = $row['unidad_insu'];
            $cantidad_old = $row['cant_disp'];
            $estado_old = $row['inactivo'];
            $nombrimagen_old = $row['img_insu'];
        }
    
        if ($nombre_new != $nombre_old) {
            $nombre = $nombre_new;
        }else {
            $nombre = $nombre_old;
        }
        if ($estado_new != $estado_old) {
            $estado = $estado_new;
        } else {
            $estado = $estado_old;
        }
        if ($precio_new != $precio_old) {
            $precio = $precio_new;
        } else {
            $precio = $precio_old;
        }
        if ($cantidad_new != $cantidad_old) {
            $cantidad = $cantidad_new;
        } else {
            $cantidad = $cantidad_old;
        }
        if ($unidad_new != $unidad_old) {
            $unidad = $unidad_new;
        } else {
            $unidad = $unidad_old;
        }
        if ($nombrimagen_new == ""){
            $imgContenido = "$nombrimagen_old";
        } else {
            $imgContenido = "$nombrimagen_new";
        }

        #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
        $query = "UPDATE insumo SET nom_insu = \"$nombre\", cant_disp = \"$cantidad\", unidad_insu = \"$unidad\", precio_insu = \"$precio\", img_insu = \"$imgContenido\", inactivo = \"$estado\" WHERE id_insu = \"$id\"";
        $result = mysqli_query($conexion, $query);
        if(!$result) {
            die("Error en la Consulta.");
        }

        #Regresa a la Pagina de los Productos
        header('location: ../insumos.php');

        } elseif ($_POST['editar'] == "recetas") {
        #Variables donde se almacenan cada dato para su subida a la BD
        $id = $_POST['id_receta'];
        $nombre_new = $_POST['nombreE'];
        $descr_new = $_POST['descrE'];
        $pasos_new = $_POST['pasosE'];

        if($_POST['estadoE'] == "on") {
            $estado_new = true;
        } else {
            $estado_new = false;
        }

        #Variables para obtener informacion relacionada al archivo de subida
        if(!$_FILES['imagenE']['name'] == ""){
            $tamano = $_FILES['imagenE']['size'];
            $imgContenido = fopen($_FILES['imagenE']['tmp_name'], 'r');
            $binarioimagen = fread($imgContenido, $tamano);
            $nombrimagen_new = mysqli_escape_string($conexion, $binarioimagen);
        }else{
            $nombrimagen_new = "";
        }

        $ingcontador = 1;
        $ingredientes_new = array();
        $ing = "Eing".$ingcontador;
        while (isset($_POST["$ing"])) {
            $uni = "Euni".$ingcontador;
            $cant = "Ecanting".$ingcontador;
            $unidad = $_POST["$uni"];
            $cantidad = $_POST["$cant"];
            $idins = $_POST["$ing"];
            $ingredientes_new[$ingcontador] = array(
                "id" => $idins,
                "unidad" => $unidad,
                "cant" => $cantidad
            );
            $ingcontador++;
            $ing = "Eing".$ingcontador;
        }
        
        $datos_bd = "SELECT * FROM receta WHERE id_rec = $id";
        $result_tasks = mysqli_query($conexion, $datos_bd);    
        while($row = mysqli_fetch_assoc($result_tasks)) {
            $nombre_old = $row['nom_r'];
            $descr_old = $row['descri_r'];
            $pasos_old = $row['pasos_r'];
            $estado_old = $row['inactivo'];
            $nombrimagen_old = $row['img_id'];
        }

        $ingredientes_old = array();
        $datos_bd = "SELECT id_insu, unidad_med, cant_in_xreceta FROM contiene WHERE id_rec = $id";
        $result_tasks = mysqli_query($conexion, $datos_bd);
        $oldcontador = 1;
        while($row = mysqli_fetch_assoc($result_tasks)) {
            $ingredientes_old[$oldcontador] = array(
                "id" => $row['id_insu'],
                "unidad" => $row['unidad_med'],
                "cant" => $row['cant_in_xreceta']
                );
            $oldcontador++;
        }

        if ($nombre_new != $nombre_old) {
            $nombre = $nombre_new;
        }else {
            $nombre = $nombre_old;
        }
        if ($descr_new != $descr_old) {
            $descr = $descr_new;
        }else {
            $descr = $descr_old;
        }
        if ($pasos_new != $pasos_old) {
            $pasos = $pasos_new;
        }else {
            $pasos = $pasos_old;
        }
        if ($estado_new != $estado_old) {
            $estado = $estado_new;
        } else {
            $estado = $estado_old;
        }
        
        if ($nombrimagen_new == ""){
            $imgContenido = "$nombrimagen_old";
        } else {
            $imgContenido = "$nombrimagen_new";
        }

        #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
        $query = "UPDATE receta SET nom_r = \"$nombre\", descri_r = \"$descr\", pasos_r = \"$pasos\", img_id = \"$imgContenido\", inactivo = \"0\" WHERE id_rec = \"$id\"";
        $result = mysqli_query($conexion, $query);
        if(!$result) {
            die("Error en la Consulta.");
        }

        $resultado = array_intersect(array_map('serialize',$ingredientes_new), array_map('serialize',$ingredientes_old));
        $contador = 1;
        if (array_map('serialize',$resultado) != array_map('serialize',$ingredientes_old)) {
            $query = "UPDATE contiene SET inactivo = true WHERE id_rec = \"$id\"";
            mysqli_query($conexion, $query);
            while ($contador != $ingcontador){
                $insumo = $ingredientes_new[$contador]['id'];
                $unidad = $ingredientes_new[$contador]['unidad'];
                $cantidad = $ingredientes_new[$contador]['cant'];
                $query = "UPDATE contiene SET unidad_med = \"$unidad\", cant_in_xreceta = \"$cantidad\", inactivo = \"false\" WHERE (id_rec = \"$id\" AND id_insu = \"$insumo\")";
                $result = mysqli_query($conexion, $query);
                if(!$result){
                    $query = "INSERT INTO contiene VALUES ('$id','$insumo','$unidad','$cantidad',false)";
                    mysqli_query($conexion, $query);
                }
                $contador++;
            }
        }

        #Regresa a la Pagina de los Productos
        header('location: ../recetas.php');
        }
}
if ($_GET['editar'] == "tfactura") {
    $codigo = $_GET['codigofactura'];
    $fecha = $_POST['fecha'];
    $respuesta = mysqli_query($conexion, "UPDATE facturas SET fecha = '$fecha' WHERE codigo = '$codigo'");
    echo json_encode($respuesta);
} elseif ($_GET['editar'] == "quitarproducto") {
    $codigo = $_GET['codigofactura'];
    $respuesta = mysqli_query($conexion, "UPDATE detallefactura SET descartada = true WHERE codigo = '$codigo'");
    echo json_encode($respuesta);
}


?>