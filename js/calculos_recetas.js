canting = 1;
filant = 2;
filasi = 3;

function agregaringrediente() {
  canting = canting+1;
  filant = filant+1;
  filasi = filasi+1;
  if ( $('#VentanaEmergenteVisualizar').length > 0 ) {
    $('#Eing1').clone(true).prop({
      id: function (i, oldId) {return 'Eing'+canting;},
      name: function (i, oldId) {return 'Eing'+canting;},
      style: 'grid-column: 4/5; grid-row:'+filant+'/'+filasi+';',
    }).appendTo('#for');
    $("#Eing"+canting +" option[value='0']").prop("selected", "selected");
    $('#Ecanting1').clone(true).prop({
      id: function (i, oldId) {return 'Ecanting'+canting;},
      name: function (i, oldId) {return 'Ecanting'+canting;},
      style: 'grid-column: 5/6; grid-row:'+filant+'/'+filasi+';',
      value: ''
    }).appendTo('#for');
    $('#Euni1').clone(true).prop({
      id: function (i, oldId) {return 'Euni'+canting;},
      name: function (i, oldId) {return 'Euni'+canting;},
      style: 'grid-column: 6/7; grid-row:'+filant+'/'+filasi+';'
    }).appendTo('#for');
    $("#Euni"+canting +" option[value='1']").prop("selected", "selected");
  } else {
    $('#ing1').clone(true).prop({
      id: function (i, oldId) {return 'ing'+canting;},
      name: function (i, oldId) {return 'ing'+canting;},
      style: 'grid-column: 4/5; grid-row:'+filant+'/'+filasi+';',
    }).appendTo('.formulario');
    $('#canting1').clone(true).prop({
      id: function (i, oldId) {return 'canting'+canting;},
      name: function (i, oldId) {return 'canting'+canting;},
      style: 'grid-column: 5/6; grid-row:'+filant+'/'+filasi+';',
      value: ''
    }).appendTo('.formulario');
    $('#uni1').clone(true).prop({
      id: function (i, oldId) {return 'uni'+canting;},
      name: function (i, oldId) {return 'uni'+canting;},
      style: 'grid-column: 6/7; grid-row:'+filant+'/'+filasi+';'
    }).appendTo('.formulario');
}
};

function quitaringrediente() {
if (canting >= "2") {
  $('#ing'+canting).remove();
  $('#canting'+canting).remove();
  $('#uni'+canting).remove();
  $('#Eing'+canting).remove();
  $('#Ecanting'+canting).remove();
  $('#Euni'+canting).remove();
  canting = canting-1;
  filant = filant-1;
  filasi = filasi-1;
}
};

$('.seling').on('change', function(event ) {
//restore previously selected value
var prevValue = $(this).data('previous');
$('.seling').not(this).find('option[value="'+prevValue+'"]').show();
//hide option selected                
var value = $(this).val();
//update previously selected data
$(this).data('previous',value);
$('.seling').not(this).find('option[value="'+value+'"]').hide();
});

$(document).on("click", ".borrarmodal", function() {
  $('#VentanaEmergenteVisualizar').remove();
  limpiar();
})

$(document).on("click", ".editar_receta", function() {
  var id = $(this).data('id');
  if ( $('#VentanaEmergenteVisualizar').length > 0 ) {
    $('#VentanaEmergenteVisualizar').remove();
  } else {
    // get needed html
    $.get("ajax/ver_receta_modal.php?idr="+id, function (result) {
      // append response to body
      $('body').append(result);
      // open modal
      $('#VentanaEmergenteVisualizar').modal('show');
    });
  }
});

function limpiar() {
if (canting > 1){
for (i=2; i <= canting; i++) {
  $('#ing'+i).remove();
  $('#canting'+i).remove();
  $('#uni'+i).remove();
}
canting = 1;
filant = 2;
filasi = 3;
}
}