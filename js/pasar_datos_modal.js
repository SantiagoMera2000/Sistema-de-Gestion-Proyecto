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
$(document).on("click", ".editar_insu", function() {
    var id = $(this).data('id').id_insu;
    var nom = $(this).data('id').nom_insu;
    var uni = $(this).data('id').unidad_insu;
    var ina = $(this).data('id').inactivo;
    //obtenemos el elemento switch para cambiar su estado
    var es = document.getElementById("estadoE");
    var costo = $(this).data('id').precio_insu;
    var cant = $(this).data('id').cant_disp;
    //var img = $(this).data('id').img_insu;
    $("#formE #id_insu").val( id );
    $("#formE #nom_insuE").val( nom );
    document.querySelector('#unidad_insuE').value = uni;
    $("#formE #estadoE").val( ina );
    if (ina == 0) {
        es.checked = true;
    }
    $("#formE #precio_insuE").val( costo );
    $("#formE #cant_dispE").val( cant );
})