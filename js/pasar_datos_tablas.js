$(".envio").on("click", function() {
var hermano=$(this).parent();
$("#facturar").prepend("<tr>\
    <td>"+hermano.siblings("td:eq(0)").text()+"</td>\
    <td>"+hermano.siblings("td:eq(1)").text()+"</td>\
    <td>"+hermano.siblings("td:eq(2)").text()+"</td>\
    <td>"+hermano.siblings("td:eq(3)").text()+"</td>\
    <td><button class=\"btn btn-danger quitar\">\
        <span class=\"material-symbols-outlined\">delete</span>\
    </button>\
    </td>\
    </tr>")
});

$("#facturar").on("click", ".quitar", function() {
    $(this).closest("tr").remove();
});