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
    where fact.descartada = false
    group by deta.codigofactura
    order by codigo desc"
    )
    or die(mysqli_error($conexionr4));

    $filas = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

    ?>
    <div class="contenedor">
    <h1>Facturas emitidas</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Número de Factura</th>
          <th>Fecha</th>
          <th>Importe</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($filas as $fila) {
          ?>
          <tr>
            <td><?php echo $fila['codigo'] ?></td>
            <td><?php echo $fila['fecha'] ?></td>
            <td class="text-right"><?php echo '$' . number_format($fila['importefactura'], 2, ',', '.'); ?></td>
            <td class="text-right">
              <a class="btn btn-primary btn-sm botonimprimir" role="button" data-bs-toggle="modal" href="#" data-codigo="<?php echo $fila['codigo'] ?>">Imprime?</a>
              <a class="btn btn-primary btn-sm botonborrar" role="button" data-bs-toggle="modal" href="#VentanaEmergenteConfirmacion" data-codigo="<?php echo $fila['codigo'] ?>">Borra?</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <button type="button" id="btnNuevaFactura" class="btn btn-success">Emitir factura</button>
  </div>

  <div class="modal fade" id="VentanaEmergenteConfirmacion" tabindex="-1" aria-labelledby="VentanaEmergenteConfirmacion" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="VentanaEmergenteConfirmacion">Confirmar Eliminación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estas seguro de que desear eliminar este producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnConfirmarBorrado" name="btnConfirmarBorrado">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
  $('#btnNuevaFactura').click(function() {
    window.location = 'emitirfactura.php';
  });
  $(document).on("click", ".botonborrar", function () {
    codigofactura = $(this).get(0).dataset.codigo;
    $("#ModalConfirmarBorrar").modal('show');
  });
  $('#btnConfirmarBorrado').click(function() {
    window.location = 'process/eliminar.php?eliminar_fact=' + codigofactura;
  });
  });
</script>
</main>

<?php include('includes/footer.php'); ?>
<script src="js\filtrador.js"></script>
<script src="js\pasar_datos_tablas.js"></script>