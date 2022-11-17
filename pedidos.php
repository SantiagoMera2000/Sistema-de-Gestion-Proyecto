<?php include("logic/conexion.php"); ?>

<?php include('includes/headermobile.php'); ?>

<!-- Estilos requeridos especialmente en esta pagina -->
<link rel="stylesheet" href="css\index.css">
<link rel="stylesheet" href="css\pedidos.css">

<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvascarrito" aria-labelledby="offcanvascarrito">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvascarrito">Mi Carrito</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
      <table>
        <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Total</th>
        </tr>
        </thead>
        <tbody>
          <tr>

          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Contenedor principal -->
<main class="main">
  <div class="row row-cols-1 row-cols-md-6 g-4 ">
    <?php
      $query = "SELECT * FROM producto ORDER BY inactivo,nom_pro ASC";
      $result_tasks = mysqli_query($conexion, $query);    
      while($row = mysqli_fetch_assoc($result_tasks)) { ?>
      <!-- Tarjetas donde se cargan los datos de la BD -->
          <?php
          if ($row['inactivo'] == false) {
            echo "<div class=\"col tarjeta\">";
          } else {
            echo "<div class=\"col inactivo oculto tarjeta\">";
          }
          ?>
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title" style="align-self: center;"><?php echo $row['nom_pro']; ?></h5>
              <hr>
              <?php
              if ($row['img_id'] == "") {
                echo "<span class=\"material-symbols-outlined agrandar-icono\">image_not_supported</span>";
              } else {
                echo "<img class=\"img-preview rounded card-img-top img-fluid\" src='data:img/jpg;base64, ".base64_encode($row['img_id'])."' alt=\"{$row['nom_pro']}\">";
              }
              ?>
              <p class="card-text"><?php echo $row['descri_pro']; ?></p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Precio: $<?php echo $row['precio_venta']; ?></li>
              <li class="list-group-item">Disponibles: <?php echo $row['cantidad']; ?></li>
            </ul>
            <div class="card-footer">
              <a class="btn btn-primary" onclick="agregarcarrito(<?php echo $row['id_prod']?>)" data-bs-toggle="offcanvas" href="#offcanvascarrito" role="button" aria-controls="offcanvascarrito">Agregar al Carrito</a>
            </divc>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</main>

<script>
  function agregarcarrito(producto){
    const nodo = document.createElement('td');
  }
</script>
<?php include('includes/footermobile.php'); ?>