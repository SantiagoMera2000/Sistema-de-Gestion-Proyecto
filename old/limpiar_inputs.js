$(document).ready(function(){
	$('.btn-secondary').click(function(){				
		/*Limpia todos los inputs que sean de tipo texto, numero y archivo*/
		$('#form input[type="text"]').val('');
    	$('#form input[type="number"]').val('');
		$('#form input[type="file"]').val('');
	});
});