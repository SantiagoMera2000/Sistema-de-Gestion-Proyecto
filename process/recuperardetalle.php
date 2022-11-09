<?php 
  require("../logic/conexion.php");
  
  $datos = mysqli_query($conexion, "
  select pro.id_prod as codigo,
  round(deta.precio,2) as precio,
  nom_pro as descr,
  deta.cantidad as cantidad,
  round(deta.precio*deta.cantidad,2) as preciototal,
  deta.codigo as coddetalle
  from detallefactura as deta
  join producto as pro on pro.id_prod=deta.codigoproducto
  where codigofactura=".$_GET['codigofactura']
) or die(mysqli_error($conexion));

  $pago=0;
  while ($fila = mysqli_fetch_assoc($datos)) {
      echo "<tr>";
      echo "<td>".$fila['codigo']."</td>";
      echo "<td>".$fila['descr']."</td>";
      echo "<td class=\"text-right\">".$fila['cantidad']."</td>";            
      echo "<td class=\"text-right\">".$fila['precio']."</td>";
      echo "<td class=\"text-right\">".$fila['preciototal']."</td>";
      echo '<td class="text-right"><a class="btn btn-primary" onclick="borrarItem('.$fila['coddetalle'].')" role="button" href="#" id="'.$fila['coddetalle'].'">Borra?</a></td>';
      echo "</tr>";      
      $pago=$pago+$fila['preciototal'];
  }
  echo "<tr>";
  echo "<td></td>";
  echo "<td></td>";      
  echo "<td></td>";            
  echo "<td class=\"text-right\"><strong>Importe total</strong></td>";              
  echo "<td class=\"text-right\"><strong>".number_format(round($pago,2),2,'.','')."</strong></td>";
  echo "<td></td>";            
  echo "</tr>";

?>