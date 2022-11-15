function filepreview(input, tipo) {
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            if (tipo == "add"){$('#imagepreview').html("<img src='"+e.target.result+"' class='img-fluid rounded vistaprevia'/>");}
            if (tipo == "edit"){$('#imagepreviewE').html("<img src='"+e.target.result+"' class='img-fluid rounded vistaprevia'/>");}
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$('#imagen').change(function(){
    filepreview(this, "add");
});
$('#imagenE').change(function(){
    filepreview(this, "edit");
});