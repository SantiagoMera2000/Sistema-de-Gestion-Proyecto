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
    $consulta = mysqli_query(
    $conexion,
    "select 
        fact.codigo as codigo,
        date_format(fecha,'%d/%m/%Y') as fecha,
        round(sum(deta.precio*deta.cantidad),2) as importefactura
        from facturas as fact
        join detallefactura as deta on deta.codigofactura=fact.codigo
        group by deta.codigofactura
        order by codigo desc"
    )
    or die(mysqli_error($conexionr4));

    $filas = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

    ?>
    <h1>Facturas emitidas</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Factura</th>
          <th>Cliente</th>
          <th>Fecha</th>
          <th class="text-right">Importe</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($filas as $fila) {
          ?>
          <tr>
            <td><?php echo $fila['codigo'] ?></td>
            <td><?php echo $fila['nombre'] ?></td>
            <td><?php echo $fila['fecha'] ?></td>
            <td class="text-right"><?php echo '$' . number_format($fila['importefactura'], 2, ',', '.'); ?></td>
            <td class="text-right">
              <a class="btn btn-primary btn-sm botonimprimir" role="button" href="#" data-codigo="<?php echo $fila['codigo'] ?>">Imprime?</a>
              <a class="btn btn-primary btn-sm botonborrar" role="button" href="#" data-codigo="<?php echo $fila['codigo'] ?>">Borra?</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <button type="button" id="btnNuevaFactura" class="btn btn-success">Emitir factura</button>
  </div>

  <!-- ModalConfirmarBorrar -->
  <div class="modal fade" id="ModalConfirmarBorrar" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="max-width: 600px" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1>¿Realmente quiere borrar la factura?</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnConfirmarBorrado" class="btn btn-success">Confirmar</button>
          <button type="button" data-dismiss="modal" class="btn btn-success">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {

      $('#btnNuevaFactura').click(function() {
        window.location = 'emitirfactura.php';
      });

      var codigofactura;

      $('.botonborrar').click(function() {
        codigofactura = $(this).get(0).dataset.codigo;
        $("#ModalConfirmarBorrar").modal();
      });

      $('#btnConfirmarBorrado').click(function() {
        window.location = 'borrarfactura.php?codigofactura=' + codigofactura;
      });

      $('.botonimprimir').click(function() {
        window.open('pdffactura.php?' + '&codigofactura=' + $(this).get(0).dataset.codigo, '_blank');
      });

    });
  </script>
    </main>

<?php include('includes/footer.php'); ?>
<script src="js\filtrador.js"></script>
<script src="js\pasar_datos_tablas.js"></script>