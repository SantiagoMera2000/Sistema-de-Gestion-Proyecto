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