<?php include('logic/conexion.php'); ?>

<!-- Ventana emergente (Modal) -->
<div class="modal fade" id="VentanaEmergenteVisualizar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="VentanaEmergenteLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="VentanaEmergente">Ver una receta</h5>
                <button type="button" class="btn-close borrarmodal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Cuerpo de la Ventana -->
            <div class="modal-body">
                <!-- Formulario para cargar los datos en la BD -->
                <form class="formulario" enctype="multipart/form-data" action="process/cargar.php" method="POST" autocomplete="off">
                    <?php
                    $id = $_GET['idr'];
                    $query = "SELECT * FROM receta WHERE id_rec=$id";
                    $receta = mysqli_query($conexion, $query);
                    while($row = mysqli_fetch_assoc($receta)) { ?>
                    <!-- Nombre del de la receta (es el nombre que usara en el producto final) -->
                    <label class="lblnombre" for="nombre">Nombre </label>
                    <input class="inpnombre form-control" type="text" id="nombreE" name="nombreE" value="<?php echo $row['nom_r']?>" required>
                    <!-- observacion de la receta para ayudar a gastronomia -->
                    <label class="lbldesc" for="descr">Observaciones </label>
                    <textarea class="inpdesc form-control" rows="2" cols="50" id="descrE" name="descrE"><?php echo $row['descri_r']?></textarea>
                    <!-- Imagen de la receta -->
                    <label class="lblimagen" for="imagen">Imagen </label>
                    <input class="imagen form-control" name="imagenE" type="file" id="imagenE"/>
                    <div class="vistaprevia img-fluid rounded" id="imagepreview"></div>
                    <!-- Pasos de elaboracion -->
                    <label class="lblela" for="ela">Pasos de elaboracion</label>
                    <textarea class="inpela form-control" id="pasosE" name="pasos" required><?php echo $row['pasos_r']?></textarea>
                    <?php } ?>
                    <!-- Agregar ingredientes -->
                    <div class="conjunto">
                        <label class="lbling" for="insumos">Ingredientes</label>
                        <button type="button" class="btn btn-primary botonagregar" onclick="agregaringrediente()">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                        <button type="button" class="btn btn-primary botonagregar" onclick="quitaringrediente()">
                            <span class="material-symbols-outlined">remove</span>
                        </button>
                    </div>
            <?php
            $query = "SELECT * FROM contiene WHERE id_rec = $id";
            $recetaingredientes = mysqli_query($conexion, $query);
            $query = "SELECT id_insu,nom_insu FROM insumo ORDER BY id_insu ASC";
            $insumos = mysqli_query($conexion, $query);
            $contador = 1;
            $filant = 2;
            $filasi = 3;
            $insuarray = array();
            while($row = mysqli_fetch_assoc($insumos)) {$insuarray[] = $row;}
            while($row1 = mysqli_fetch_assoc($recetaingredientes)){
                echo "<select class=\"form-select seling\" aria-label=\"Ingredientes\" id=\"Eing{$contador}\" name=\"Eing{$contador}\" style=\"grid-column: 4/5; grid-row:{$filant}/{$filasi};\">";
                echo "<option value=\"0\">Ninguno Seleccionado</option>";
                foreach ($insuarray as $insuarray1) {
                    if ($insuarray1['id_insu'] == $row1['id_insu']) {
                    echo "<option value=\"{$insuarray1['id_insu']}\" selected>{$insuarray1['nom_insu']}</option>";
                    }else{
                    echo "<option value=\"{$insuarray1['id_insu']}\">{$insuarray1['nom_insu']}</option>";
                    }
                }

                echo "</select>";
                echo "<input class=\"inping form-control\" type=\"number\" id=\"Ecanting{$contador}\" name=\"Ecanting{$contador}\" min=\"0\" placeholder=\"Ingrese la cantidad\" value=\"{$row1['cant_in_xreceta']}\" style=\"grid-column: 5/6; grid-row:{$filant}/{$filasi};\" required>";
                echo "<select class=\"form-select selingun\" aria-label=\"Unidad de Medida\" id=\"Euni{$contador}\" name=\"Euni{$contador}\" style=\"grid-column: 6/7; grid-row:{$filant}/{$filasi};\">";

                if ($row1['unidad_med'] == "1"){
                    echo "<option value=\"1\" selected>l</option>";
                }else{
                    echo "<option value=\"1\">l</option>";
                };
                if ($row1['unidad_med'] == "2"){
                    echo "<option value=\"2\" selected>ml</option>";
                }else{
                    echo "<option value=\"2\">ml</option>";
                };
                if ($row1['unidad_med'] == "3"){
                    echo "<option value=\"3\" selected>kg</option>";
                }else{
                    echo "<option value=\"3\">kg</option>";
                };
                if ($row1['unidad_med'] == "4"){
                    echo "<option value=\"4\" selected>gr</option>";
                }else{
                    echo "<option value=\"4\">gr</option>";
                }
                if ($row1['unidad_med'] == "5"){
                    echo "<option value=\"5\" selected>c.c.</option>";
                }else{
                    echo "<option value=\"5\">c.c.</option>";
                };
                if ($row1['unidad_med'] == "6"){
                    echo "<option value=\"6\" selected>pizca</option>";
                }else{
                    echo "<option value=\"6\">pizca</option>";
                };
                if ($row1['unidad_med'] == "7"){
                    echo "<option value=\"7\" selected>cda</option>";
                }else{
                    echo "<option value=\"7\">cda</option>";
                };
                if ($row1['unidad_med'] == "8"){
                    echo "<option value=\"8\" selected>C/N</option>";
                }else{
                    echo "<option value=\"8\">C/N</option>";
                };
                
            echo "</select>";
            $contador = $contador+1;
            $filant = $filant+1;
            $filasi = $filasi+1;
            } 
            ?>
            </div>
            <!-- Pie de la ventana emergente -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" id="modoeditar" data-bs-toggle="button">Activar Edición</button>
                <button type="button" class="btn btn-secondary borrarmodal" data-bs-dismiss="modal" onClick="this.form.reset()">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="editar" name="editar" value="recetas" >Agregar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    var n = document.getElementById("nombreE");
    var d = document.getElementById("descrE");
    var i = document.getElementById("imagenE");
    var p = document.getElementById("pasosE");
    var enviar = document.getElementById("editar");
    var clickBtn = document.getElementById("modoeditar");
    
    n.disabled = true;
    d.disabled = true;
    i.disabled = true;
    p.disabled = true;
    enviar.disabled = true;

    for (let index = 1; index < 100; index++) {
        document.getElementsByClassName('seling')[index].id = function() { var a = this }
        if(a.length > 0) {
            if (document.getElementById(document.getElementsByClassName('seling')[index].id).disabled) {
                document.getElementById(document.getElementsByClassName('seling')[index].id).disabled = false;
                document.getElementById(document.getElementsByClassName('selingun')[index].id).disabled = false;
                document.getElementById(document.getElementsByClassName('inping')[index].id).disabled = false;
            }else{
                document.getElementById(document.getElementsByClassName('seling')[index].id).disabled = true;
                document.getElementById(document.getElementsByClassName('selingun')[index].id).disabled = true;
                document.getElementById(document.getElementsByClassName('inping')[index].id).disabled = true;
            }
        }else{
            break;
        }
    }

    clickBtn.addEventListener('click', function(event) {
        n.disabled = !n.disabled;
        d.disabled = !d.disabled;
        i.disabled = !i.disabled;
        p.disabled = !p.disabled;
        enviar.disabled = !enviar.disabled;
    })
    document.getElementById('ver').addEventListener('click', function(event) {
        n.disabled = !n.disabled;
        d.disabled = !d.disabled;
        i.disabled = !i.disabled;
        p.disabled = !p.disabled;
        enviar.disabled = !enviar.disabled;

        for (let index = 1; index < 100; index++) {
            document.getElementsByClassName('seling')[index].id = function() { var a = this }
            if(a.length > 0) {
                if (document.getElementById(document.getElementsByClassName('seling')[index].id).disabled) {
                    document.getElementById(document.getElementsByClassName('seling')[index].id).disabled = false;
                    document.getElementById(document.getElementsByClassName('selingun')[index].id).disabled = false;
                    document.getElementById(document.getElementsByClassName('inping')[index].id).disabled = false;
                }else{
                    document.getElementById(document.getElementsByClassName('seling')[index].id).disabled = true;
                    document.getElementById(document.getElementsByClassName('selingun')[index].id).disabled = true;
                    document.getElementById(document.getElementsByClassName('inping')[index].id).disabled = true;
                }
            }else{
                break;
            }
        }
    })
    
</script>