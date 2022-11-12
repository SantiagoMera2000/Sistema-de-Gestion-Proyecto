<?php

include('../logic/conexion.php');

$query = "SELECT img_id FROM producto WHERE id_prod = ".$_GET['id'];
$request = mysqli_query($conexion, $query);
$imagen = mysqli_fetch_assoc($request);

echo "<img class=\"img-preview rounded card-img-top img-fluid\" src='data:img/jpg;base64, ".base64_encode($imagen['img_id'])."' alt=\"".$_GET['nom']."\">";

?>