<?php include('../logic/conexion.php'); ?>

<!-- Ventana para ver y editar producto -->
  <div class="modal fade" id="VentanaEmergenteEdit" tabindex="-1" aria-labelledby="VentanaEmergenteLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="VentanaEmergente">Editar usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Cuerpo de la Ventana -->
      <div class="modal-body">
        <br>
        <!-- Formulario para cargar los datos en la BD -->
        <form class="formulario" enctype="multipart/form-data" action="process/cargar.php" method="POST">
        <?php
                    $id = $_GET['idu'];
                    $query = "SELECT * FROM persona, permisos WHERE id=id_pe and id=$id";
                    $usuario = mysqli_query($conexion, $query);
                    while($row = mysqli_fetch_assoc($usuario)) { ?> 
        <!-- Nombre del Usuario -->
          <label class="lblnombre" for="nombre">Nombre </label>
          <input class="inpnombre" type="text" id="nom_usu" name="nom_usu" required value="<?php echo $row['nombre']?>">
          <!-- Apellido usuario -->
          <label class="lblapellido" for="apellido">Apellido</label>
          <input class="inpapellido" type="text" id="ape_usu" name="ape_usu" required value="<?php echo $row['apellido']?>">
          <!-- Email usuario -->
          <label class="lblemail" for="email">Email</label>
          <input class="email" type="email" name="email" value="<?php echo $row['email']?>">
          <!-- clave usuario -->
          <label class="lblclave" for="clave">Contraseña</label>
          <input class="clave" type="password" name="clave">
          <!-- Estado del usuario (Visible) -->
          <label class="form-check-label lblestado" for="estado">Visible</label>
          <div class="form-check form-switch estado">
            <?php 
            if($row['inactivo']==false){
               echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"estado\">";
            } else{
                echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"estado\" checked>";
            }
             ?>
          </div>
          <!-- Permisos a usuarios -->
          <label class="form-check-label lblpermisos">Aplicar Permisos:</label>
          <label class="form-check-label lblpermiso_insu" for="permiso_insu">Insumos</label>
          <div class="form-check form-switch permiso_insu">
          <?php 
            if($row['insumos']==false){
               echo "<input class= \"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_insu\" name=\"permiso_insu\">";
            } else{
                echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_insu\" name=\"permiso_insu\" checked>";
            }
             ?>
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_insu" name="permiso_insu">
          </div>
          <label class="form-check-label lblpermiso_rec" for="permiso_rec">Recetas</label>
          <div class="form-check form-switch permiso_rec">
         <?php
          if($row['recetas']==false){
               echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_rec\" name=\"permiso_rec\">";
            } else{
               echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_rec\" name=\"permiso_rec\" checked>";
            }
             ?>
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_rec" name="permiso_rec">
          </div>
          <label class="form-check-label lblpermiso_prod" for="permiso_prod">Productos</label>
          <div class="form-check form-switch permiso_prod">
          <?php
          if($row['productos']==false){
               echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_prod\" name=\"permiso_prod\">";
            } else{
               echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_prod\" name=\"permiso_prod\" checked>";
            }
             ?>
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_prod" name="permiso_prod">
          </div>
          <label class="form-check-label lblpermiso_orden" for="permiso_orden">Producción</label>
          <div class="form-check form-switch permiso_orden">
          <?php
          if($row['orden_de_produccion']==false){
               echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_orden\" name=\"permiso_orden\">";
            } else{
               echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_orden\" name=\"permiso_orden\" checked>";
            }
             ?>
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_orden" name="permiso_orden">
          </div>
          <label class="form-check-label lblpermiso_facturacion" for="permiso_facturacion">Facturación</label>
          <div class="form-check form-switch permiso_facturacion">
            <?php
          if($row['facturacion']==false){
               echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_facturacion\" name=\"permiso_facturacion\">";
            } else{
               echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_facturacion\" name=\"permiso_facturacion\" checked>";
            }
             ?>
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_facturacion" name="permiso_facturacion">
          </div>
          <label class="form-check-label lblpermiso_admin" for="permiso_admin">Administrador</label>
          <div class="form-check form-switch permiso_admin">
          <?php
          if($row['panel_admin']==false){
               echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_admin\" name=\"permiso_admin\">";
            } else{
               echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"permiso_admin\" name=\"permiso_admin\" checked>";
            }
             ?>
            <input class="form-check-input" type="checkbox" role="switch" id="permiso_admin" name="permiso_admin">
          </div>
          </select>
            <?php } ?>
        </div> 
          <!-- Pie de la ventana emergente -->
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" id="modoeditar" data-bs-toggle="button">Activar Edición</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="editar" name="editar" value="usuario" >Completar edición</button>
          </div>
        </form>
      </div>
    </div>
  </div>