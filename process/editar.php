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
    $nombrimagen_new = $_FILES['imagenE']['name'];

    #Verificamos el estado del switch de visibilidad
    if($_POST['estadoE'] == "on") {
        $estado_new = false;
    } else {
        $estado_new = true;
    }

    #Variables para obtener informacion relacionada al archivo de subida
    $ruta_indexphp = dirname(realpath(__FILE__));
    $ruta_fichero_origen = $_FILES['imagenE']['tmp_name'];
    $ruta_nuevo_destino = $ruta_indexphp . '../img/producto/' . $_FILES['imagenE']['name'];

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
    if ($nombrimagen_new != $nombrimagen_old) {
        if ($nombrimagen_new != ""){
        $nombrimagen = $nombrimagen_new;
        #Subida de archivos al servidor en el Apache
        move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino );
        } else {
            $nombrimagen = $nombrimagen_old;
        }
    } else {
        $nombrimagen = $nombrimagen_old;
    }


    #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
    $query = "UPDATE producto SET nom_pro = \"$nombre\", descri_pro = \"$descr\", tipo = \"$tipo\", inactivo = \"$estado\", precio_elav = \"$precio_elab\", precio_venta = \"$precio_venta\", cantidad = \"$cantidad\", img_id = \"$nombrimagen\" WHERE id_prod = \"$id\"";
    $result = mysqli_query($conexion, $query);
    if(!$result) {
        die("Error en la Consulta.");
    }
    #Regresa a la Pagina de los Productos
    header('location: ../productos.php');
    }


    if ($_POST['editar'] == "insumo" ) {
        #Variables donde se almacenan cada dato para su subida a la BD
        $id = $_POST['id_insu'];
        $nombre_new = $_POST['nom_insuE'];
        $precio_new = $_POST['precio_insuE'];
        $unidad_new = $_POST['unidad_insuE'];
        $cantidad_new = $_POST['cant_dispE'];
        $estado_new = $_POST['estadoE'];
        $nombrimagen_new = $_FILES['imagenE']['name'];
    
        #Verificamos el estado del switch de visibilidad
        if($_POST['estadoE'] == "on") {
            $estado_new = true;
        } else {
            $estado_new = false;
        }
    
        #Variables para obtener informacion relacionada al archivo de subida
        $ruta_indexphp = dirname(realpath(__FILE__));
        $ruta_fichero_origen = $_FILES['imagenE']['tmp_name'];
        $ruta_nuevo_destino = $ruta_indexphp . '../img/insumo/' . $_FILES['imagenE']['name'];
    
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
        if ($nombrimagen_new != $nombrimagen_old) {
            if ($nombrimagen_new != ""){
            $nombrimagen = "$nombrimagen_new";
            #Subida de archivos al servidor en el Apache
            move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino );
            } else {
                $nombrimagen = "$nombrimagen_old";
            }
        } else {
            $nombrimagen = "$nombrimagen_old";
        }
    
    
        #Luego de realizado todo lo anterior con exito, se sube la informacion proporcionada a la BD
        $query = "UPDATE insumo SET nom_insu = \"$nombre\", cant_disp = \"$cantidad\", unidad_insu = \"$unidad\", precio_insu = \"$precio\", img_insu = \"$nombrimagen\", inactivo = \"$estado\" WHERE id_insu = \"$id\"";
        $result = mysqli_query($conexion, $query);
        if(!$result) {
            die("Error en la Consulta.");
        }
    
        #Regresa a la Pagina de los Productos
        header('location: ../insumos.php');
        }
};

?>