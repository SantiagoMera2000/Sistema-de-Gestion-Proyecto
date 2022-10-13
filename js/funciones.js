(function(){
function filepreview(input) {
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#imagepreview').html("<img src='"+e.target.result+"' style='object-fit: cover;'/>");
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$('#imagen').change(function(){
    filepreview(this);
}
);
})();