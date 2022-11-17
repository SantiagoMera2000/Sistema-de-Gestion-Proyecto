<?php

include('../logic/conexion.php');

$atrr = $_GET['atrr'];
$tabla = $_GET['tabla'];
$prim = $_GET['prim'];
$query = "SELECT $atrr FROM $tabla WHERE $prim = ".$_GET['id'];
$request = mysqli_query($conexion, $query);
$imagen = mysqli_fetch_assoc($request);

if (!empty($imagen[$atrr])){
    echo "<img class=\"vistaprevia rounded card-img-top img-fluid\" src='data:img/jpg;base64, ".base64_encode($imagen[$atrr])."' alt=\"".$_GET['nom']."\">";
}
?>