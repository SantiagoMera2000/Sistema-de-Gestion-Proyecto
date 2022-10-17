<!-- Cuerpo de pagina universal -->
<!DOCTYPE html>
<html lang="es">
    <meta charset="UTF-8">
    <title>Sistema de Gestión Web</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- BOOTSTRAP 5 -->
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- MATERIAL DESIGN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- SOURCE SANS PRO REGULAR 400-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="assets\fontawesome\css\all.css" rel="stylesheet">
    <!-- NORMALIZE -->
    <link rel="stylesheet" href="css\normalize.css" rel="stylesheet">
    <!-- ESTILO PRINCIPAL -->
    <link rel="stylesheet" href="css\main.css" rel="stylesheet">
  </head>
  <body>

<!-- Barra de navegacion superior -->
<nav class="navbar navbar-nav navbar-dark bg-dark">
  <div class="container-md">
    <a class="navbar-brand" href="index.php">
      <img src="img\Logo_Sistema.png" alt="Sistema Optimo de Gestión para Empresas" width="40">
    </a>
    <li class="nav-item opc">
      <a class="nav-link" href="index.php">Inicio</a>
    </li>
    <li class="nav-item opc">
      <a id="p" class="nav-link" href="productos.php">Productos</a>
    </li>
    <li class="nav-item opc">
      <a id="i" class="nav-link" href="insumos.php">Insumos</a>
    </li>
    <li class="nav-item opc">
      <a id="r" class="nav-link" href="recetas.php">Recetas</a>
    </li>
    <li class="nav-item opc">
      <a id="e" class="nav-link" href="estadisticas.php">Estadisticas</a>
    </li>
    <li class="nav-item opc">
      <a id="f" class="nav-link" href="facturacion.php">Facturación</a>
    </li>
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