(function(){
function filepreview(input) {
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#imagepreview').html("<img src='"+e.target.result+"' style='max-width: 200px;'/>");
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$('#imagen').change(function(){
    filepreview(this);
}
);
})();