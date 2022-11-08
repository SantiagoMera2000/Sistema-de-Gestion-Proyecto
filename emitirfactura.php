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
    $consulta = mysqli_query($conexion, "select max(codigo) as codigo from facturas");
    while($row = mysqli_fetch_assoc($consulta)) {$codigofactura = $row['codigo']; $codigofactura++; }
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
            <input type="date" class="form-control" id="Fecha">
          </div>
        </div>

      </div>
      <div class="col-md">
        <div class="form-group row">
          <label for="Pago" class="col-lg-3 col-form-label">Total a Pagar:</label>
          <div class="col-lg-3 col-form-label">
            <label for="Precio" id="Total">$0</label>
          </div>

        <br>
        <br>
        <br>

          <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#VentanaEmergente">Agregar Producto</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#VentanaEmergenteFinalizar">Terminar Factura</button>
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
          <tbody id="DetalleFactura"></tbody>
        </table>
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
            <button type="submit" class="btn btn-primary" onclick="guardar()">Agregar</button>
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
            <button type="button" id="btnConfirmarFactura" class="btn btn-success">Confirmar Factura</button>
            <button type="button" id="btnConfirmarImprimirFactura" class="btn btn-success">Confirmar e Imprimir Factura</button>
            <button type="button" class="btn btn-success" onclick="salir()">Descartar la Factura</button>
        </div>
        </div>
    </div>
</div>


<!-- ModalConfirmarBorrar -->
<div class="modal fade " id="VentanaEmergenteBorrar" data-bs-backdrop="static" tabindex="-1" aria-labelledby="VentanaEmergente" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1>¿Realmente quiere borrarlo?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnConfirmarBorrado" class="btn btn-success">Confirmar</button>
            <button type="button" data-dismiss="modal" class="btn btn-success">Cancelar</button>
        </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('Fecha').valueAsDate = new Date();
    });
</script>
<script>
  var _total = 0;
  function guardar(){
    var _prod = $('#Producto :selected');
    var _can = document.getElementById("Cantidad").value;

    var _id = $(_prod).data('id').id_prod;
    var _nom = $(_prod).data('id').nom_pro; 
    var _precio = $(_prod).data('id').precio_venta;
    var _cantidad = $(_prod).data('id').cantidad;
    var _precio_can = _precio*_can;

    if ( _can < _cantidad) {

    var fila="<tr><td>"+_id+"</td><td>"+_nom +"</td><td>"+_can +"</td><td>"+_precio+"</td><td>"+_precio_can+"</td></tr>";

    var btn = document.createElement("TR");
    btn.innerHTML=fila;
    document.getElementById("factura").appendChild(btn);

    _total = _total+_precio_can;
    document.querySelector('#Total').innerText = '$ '+_total;

    }
  }
function salir(){
  window.location="facturacion.php";
}
</script>
<?php include('includes/footer.php'); ?>
<script src="js\filtrador.js"></script>
<script src="js\pasar_datos_tablas.js"></script>