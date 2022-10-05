<!-- Cuerpo de pagina universal -->
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión Web</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- BOOTSTRAP 5 -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MATERIAL YOU -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="assets\fontawesome\css\all.css" rel="stylesheet">
    <!-- NORMALIZE -->
    <link rel="stylesheet" href="css\normalize.css" rel="stylesheet">
    <!-- ESTILO PRINCIPAL -->
    <link rel="stylesheet" href="css\main.css" rel="stylesheet">
  </head>
  <body>

<nav class="navbar bg-light">
  <div class="container-md">
    <a class="navbar-brand" href="index.php">
      <img src="img\Logo_Sistema.png" alt="Sistema Optimo de Gestión para Empresas" width="40">
    </a>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="material-symbols-outlined user">account_circle</span>
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item menuperfil cerrar" href="logic\salir.php">Cerrar Sesión</a></li>
      </ul>
    </li>
  </div>
</nav>
<!-- Barra de navegacion superior
<div class="container-fluid">
  <div class="row justify-content-center align-content-center">
    <div class="col-8 barra">
      <a href="index.php"><img src="img/Logo_Sistema.png" alt="" width="40px"></a>
    </div>
    <div class="col-4 text-right barra">
      <ul class="navbar-nav mr-auto">
        <li>
          <a href="#" class="px-3 text-light perfil dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle user"></i></a>
          <div class="dropdown-menu" aria-labelledby="navbar-dropdown">
            <a class="dropdown-item menuperfil cerrar" href="logic\salir.php"><i class="fas fa-sign-out-alt m-1"></i>Cerrar Sesión</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
-->
<!-- OBSOLETOS SOLO PARA TESTEO O FUTURA INCLUSION -->
<!-- Barra lateral de navegacion
    <div class="container-fluid">
        <div class="row">
            <div class="barra-lateral col-12 col-sm-auto">
                <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                    <a href="#"><i class="fas fa-home"></i><span>Inicio</span></a>
                    <a href="#"><i class="fas fa-archive"></i><span>Inventario</span></a>
                    <a href="#"><i class="fas fa-shopping-cart"></i><span>Productos</span></a>
                    <a href="#"><i class="fas fa-user-tie"></i><span>Clientes</span></a>
                </nav>
            </div>
-->

<!-- <div id="navegador">
  <ul>
    <li><a href="#">Elemento 1</a></li>
    <li><a href="#">Elemento 2</a></li>
    <li><a href="#">Elemento 3</a></li>
    <li><a href="#">Elemento 4</a></li>
  </ul>
</div> -->

<!-- DESACTIVADO
  <nav>
    <div class="container-top">
      <div class="btn-sidebar">
          <span class="material-symbols-outlined">menu</span>
      </div>
      <ul class="links">
        <li class="link"><a href="#">Opcion 2</a></li>
        <li class="link"><a href='logic/salir.php'><span class="material-symbols-outlined">logout</span></a></li>
      </ul>
    </div>
  </nav>
-->