(function(){
function filepreview(input) {
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            if ($('#imagepreview').length > 0){
                $('#imagepreview').remove();
            }else{
                $('#imagepreview').html("<img src='"+e.target.result+"' class='img-fluid rounded vistaprevia'/>");
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$('#imagen').change(function(){
    filepreview(this);
}
);
})();