$(document).on("click", ".eliminar", function () {
    var IdProducto = $(this).data('id');
    $(".modal-footer #eliminar_prod").val( IdProducto );
});
$(document).on("click", ".eliminar_rec", function () {
    var IdProducto = $(this).data('id');
    $(".modal-footer #eliminar_rec").val( IdProducto );
});
$(document).on("click", ".eliminar", function () {
    var IdProducto = $(this).data('id');
    $(".modal-footer #eliminar_insu").val( IdProducto );
});

$(document).on("click", ".editar", function () {
    var id = $(this).data('id').id_prod;
    var nom = $(this).data('id').nom_pro;
    var des = $(this).data('id').descri_pro;
    var tipo = $(this).data('id').tipo;
    var ina = $(this).data('id').inactivo;
    //obtenemos el elemento switch para cambiar su estado
    var es = document.getElementById("estadoE");
    var elab = $(this).data('id').precio_elav;
    var venta = $(this).data('id').precio_venta;
    var cant = $(this).data('id').cantidad;
    //var img = $(this).data('id').img_id;
    $("#formE #id_prod").val( id );
    $("#formE #nombreE").val( nom );
    $("#formE #descrE").val( des );
    $("#formE #tipoE").val( tipo );
    if (ina == 0) {
        es.checked = true;
    }
    $("#formE #precio_elabE").val( elab );
    $("#formE #precio_ventaE").val( venta );
    $("#formE #cantidadE").val( cant );
    //$("#formE #").val( img );
});