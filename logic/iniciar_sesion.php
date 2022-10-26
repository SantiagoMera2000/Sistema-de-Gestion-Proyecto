<?php
require 'conexion.php';
session_start();

$email = $_POST['email'];
$clave = $_POST['clave'];

$q = "SELECT COUNT(*) as contar from persona where email = '$email' and clave = '$clave'";
$consulta = mysqli_query($conexion,$q);
$array = mysqli_fetch_array($consulta);

if($array['contar']>0){
    $_SESSION['username'] = $usuario;
    header("location: ../index.php");
}else{
    $_SESSION['message'] = 'Usuario o contraseña incorrectos.';
    header('location: ../login.php');
}

?>