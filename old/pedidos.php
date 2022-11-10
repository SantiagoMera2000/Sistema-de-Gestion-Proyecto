<?php include("logic/conexion.php"); ?>

<?php include('includes/headermobile.php'); ?>

<!-- Estilos requeridos especialmente en esta pagina -->
<link rel="stylesheet" href="css\index.css">
<link rel="stylesheet" href="css\pedidos.css">

<div id="Carrusel" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#Carrusel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#Carrusel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#Carrusel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">
      <img src="img\producto\bizcochuelo.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="5000">
      <img src="img\producto\Fideos.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="5000">
      <img src="img\producto\Milaconpure.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#Carrusel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#Carrusel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<br>
<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
        <div class="card div-config agregados">
            <a href='#'>
                <div class="card-body">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <h5 class="card-title">Realizar un pedido</h5>
                </div>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="card div-config agregados">
            <a href='#'>
                <div class="card-body">
                    <span class="material-symbols-outlined">list_alt</span>
                    <h5 class="card-title">Mis Pedidos</h5>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include('includes/footermobile.php'); ?>