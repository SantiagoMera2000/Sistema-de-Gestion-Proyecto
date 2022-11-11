<?php

include('../logic/conexion.php');

$query = "SELECT img_id FROM producto WHERE id_prod = ".$_GET['id'];
$request = mysqli_query($conexion, $query);

echo json_encode($request);
?>