$(document).ready(function(){
	$('.btn-secondary').click(function(){				
		/*Clear all input type="text" box*/
		$('#form input[type="text"]').val('');
    $('#form input[type="number"]').val('');
	});
});