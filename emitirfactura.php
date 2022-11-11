<!-- Se llama a la BD para establecer conexion -->
<?php include("logic/conexion.php"); ?>
<!-- Se carga el header universal de cada pagina -->
<?php include('includes/header.php'); ?>
<!-- Verifica que el usuario inició sesion, de lo contrario
lo envia de nuevo al login -->
<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location: login.php");
}
?>
<!-- Estilos requeridos especialmente en esta pagina -->
<link rel="stylesheet" href="css\facturacion.css">

<body>
<?php
    require("logic\conexion.php");
    $consulta = mysqli_query($conexion, "INSERT INTO facturas VALUES ('0','0000-00-00','false')")
    or die(mysqli_error($conexion));
    $codigofactura = mysqli_insert_id($conexion);
  ?>


<div class="container">
    <div class="row mt-4">
      <div class="col-md">

        <div class="form-group row">
          <label for="CodigoFactura" class="col-lg-3 col-form-label">Número de factura:</label>
          <div class="col-lg-3">
            <input type="text" disabled class="form-control" id="CodigoFactura" value="<?php echo $codigofactura; ?>">
          </div>
        </div>


        <div class="form-group row">
          <label for="Fecha" class="col-lg-3 col-form-label">Fecha de emisión:</label>
          <div class="col-lg-3">
            <input type="date" class="form-control" id="Fecha" disabled>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md">
        <table class="table table-striped" id="factura">
          <thead>
            <tr>
              <th>Código de Artículo</th>
              <th>Descripción</th>
              <th class="text-right">Cantidad</th>
              <th class="text-right">Precio Unitario</th>
              <th class="text-right">Total</th>
              <th class="text-right"></th>
            </tr>
          </thead>
          <tbody id="DetalleFactura">

          </tbody>
        </table>
        <button type="button" data-bs-toggle="modal" data-bs-target="#VentanaEmergente" role="button" class="btn btn-primary">Agregar Producto</button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#VentanaEmergenteFinalizar" role="button" id="btnTerminarFactura" class="btn btn-success">Terminar Factura</button>
      </div>
    </div>
  </div>



<!-- ModalProducto(Agregar) -->
<div class="modal fade " id="VentanaEmergente" data-bs-backdrop="static" tabindex="-1" aria-labelledby="VentanaEmergente" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-top">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar un Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Producto:</label>
                <select class="form-control" id="Producto">
                <?php
                $consulta = mysqli_query($conexion, "select id_prod, nom_pro, precio_venta, cantidad from producto");
                while ($pro = mysqli_fetch_assoc($consulta)) {
echo "<option value='".$pro['id_prod']."' data-id='{\"id_prod\":\"".$pro['id_prod']."\",\"nom_pro\":\"".$pro['nom_pro']."\",\"precio_venta\":\"".$pro['precio_venta']."\",\"cantidad\":\"".$pro['cantidad']."\"}'>". $pro['nom_pro'].'($'. $pro['precio_venta'].")</option>";
                }
                ?>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Cantidad:</label>
                    <input type="number" id="Cantidad" class="form-control" placeholder="" value="1" min="1" required>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onClick="this.form.reset()" id="cancelar" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="agregar()" data-bs-dismiss="modal">Agregar</button>
        </div>
    </div>
    </div>
</div>


<!-- ModalFinFactura -->
<div class="modal fade " id="VentanaEmergenteFinalizar" data-bs-backdrop="static" tabindex="-1" aria-labelledby="VentanaEmergente" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-top">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Acciones</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnConfirmarFactura" class="btn btn-success" onclick="terminarfactura()">Confirmar Factura</button>
            <button type="button" id="btnConfirmarImprimirFactura" class="btn btn-success">Confirmar e Imprimir Factura</button>
            <form enctype="multipart/form-data" action="process/eliminar.php" method="POST">
              <button type="submit" class="btn btn-success" name="eliminar_fact" id="eliminar_fact" value="<?php echo $codigofactura; ?>">Descartar la Factura</button>
            </form>
        </div>
        </div>
    </div>
</div>


<!-- ModalConfirmarBorrar -->
<div class="modal fade " id="VentanaEmergenteBorrar" data-bs-backdrop="static" tabindex="-1" aria-labelledby="VentanaEmergente" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5>¿Realmente quiere borrarlo?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
            <button type="button" data-bs-dismiss="modal" class="btn btn-success" onclick="confirmadoeliminar()">Confirmar</button>
            <button type="button" data-bs-dismiss="modal" class="btn btn-success">Cancelar</button>
        </div>
        </div>
    </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('Fecha').valueAsDate = new Date();
  });
  function RecolectarDatosFormulario() {
    _prod = $('#Producto :selected');
    producto = {
      codigoproducto: $(_prod).data('id').id_prod,
      cantidad: $('#Cantidad').val()
    };
  };
  function agregar() {
    RecolectarDatosFormulario();
    EnviarInformacionProducto("apfactura");
  };
  function terminarfactura() {
    fecha = {fecha: $('#Fecha').val()};
    EnviarInformacionFactura("tfactura");
  };
  function EnviarInformacionProducto(accion) {
    $.ajax({
    type: 'POST',
    url: 'process/cargar.php?cargar=' + accion + '&codigofactura=' + <?php echo $codigofactura ?>,
    data: producto,
    success: function(msg) {
        RecuperarDetalle();
    },
    error: function() {
      alert("Hay un error ..");
    }
    });
  }
  function EnviarInformacionFactura(accion) {
    $.ajax({
      type: 'POST',
      url: 'process/editar.php?editar=' + accion + '&codigofactura=' + <?php echo $codigofactura ?>,
      data: fecha,
      success: function(msg) {
        window.location = 'facturacion.php';
      },
      error: function() {
        alert("Hay un error ..");
      }
    });
  }
  function RecuperarDetalle() {
    $.ajax({
      type: 'GET',
      url: 'process/recuperardetalle.php?codigofactura=' + <?php echo $codigofactura ?>,
      success: function(datos) {
        document.getElementById('DetalleFactura').innerHTML = datos;
      },
      error: function() {
        alert("Hay un error ..");
      }
    });
  }
  function borrarItem(coddetalle) {
    cod = coddetalle;
    $("#VentanaEmergenteBorrar").modal('show');
  }
  function confirmadoeliminar() {
    $.ajax({
      type: 'POST',
      url: 'process/editar.php?editar=quitarproducto&codigofactura=' + cod,
      success: function(msg) {
        RecuperarDetalle();
      },
      error: function() {
        alert("Hay un error ..");
      }
    });
  };
</script>

<?php include('includes/footer.php'); ?>
<script src="js\filtrador.js"></script>
<script src="js\pasar_datos_tablas.js"></script>