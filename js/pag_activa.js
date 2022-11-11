var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/')+1);
if (filename == "index.php") {
    $('.opc').css("display","none");
};
if (filename == "productos.php") {
    $('#p').addClass('active');
};
if (filename == "insumos.php") {
    $('#i').addClass('active');
};
if (filename == "recetas.php") {
    $('#r').addClass('active');
};
if (filename == "facturacion.php") {
    $('#f').addClass('active');
};
if (filename == "emitirfactura.php") {
    $('.opc').css("display","none");
};
if (filename == "estadisticas.php") {
    $('#e').addClass('active');
};

