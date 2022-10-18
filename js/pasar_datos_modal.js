$(document).on("click", ".eliminar_pro", function () {
    var IdProducto = $(this).data('id');
    console.log(IdProducto);
    $(".modal-footer #eliminar_prod").val( IdProducto );
});
$(document).on("click", ".eliminar_rec", function () {
    var IdProducto = $(this).data('id');
    console.log(IdProducto);
    $(".modal-footer #eliminar_rec").val( IdProducto );
});

$(document).on("click", ".editar", function () {
    var id = $(this).data('id').id_prod;
    var nom = $(this).data('id').nom_pro;
    var des = $(this).data('id').descri_pro;
    var tipo = $(this).data('id').tipo;
    var elab = $(this).data('id').precio_elav;
    var venta = $(this).data('id').precio_venta;
    var cant = $(this).data('id').cantidad;
    $(".formulario #productoeditar").val( id );
    $(".formulario #nombre").val( nom );
    $(".formulario #descr").val( des );
    $(".formulario #tipo").val( tipo );
    $(".formulario #precio_elab").val( elab );
    $(".formulario #precio_venta").val( venta );
    $(".formulario #cantidad").val( cant );
});