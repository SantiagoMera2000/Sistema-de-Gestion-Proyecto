<?php

$host = "localhost";
$usuario = "root";
$clave = "";
$bd = "sgg_db";

$conexion = mysqli_connect($host,$usuario,$clave,$bd);

if(!$conexion){
    echo "Error en la conexion";
}

?>