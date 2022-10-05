<?php

include("logic/conexion.php");
session_start();

$query = "DELETE FROM producto WHERE id=0";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die("Error en la Consulta.");
  }