$(document).on("click", ".eliminar", function () {
    var IdProducto = $(this).data('id');
    console.log(IdProducto);
    $(".modal-footer #eliminar_prod").val( IdProducto );
});