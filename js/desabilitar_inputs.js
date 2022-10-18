// Almacenta los elementos en variables
var n = document.getElementById("nombreE");
var d = document.getElementById("descrE");
var t = document.getElementById("tipoE");
var pe = document.getElementById("precio_elabE");
var pv = document.getElementById("precio_ventaE");
var c = document.getElementById("cantidadE");
var e = document.getElementById("estadoE");
var i = document.getElementById("imagenE");
var enviar = document.getElementById("editar");
var clickBtn = document.getElementById("modoeditar");

// Desabilita todos los inputs despues de cargar la pagina
n.disabled = true;
d.disabled = true;
t.disabled = true;
pe.disabled = true;
pv.disabled = true;
c.disabled = true;
e.disabled = true;
i.disabled = true;
enviar.disabled = true;

//agregamos un evento al hacer click en "Activar edicion"
clickBtn.addEventListener('click', function(event) {
    n.disabled = !n.disabled;
    d.disabled = !d.disabled;
    t.disabled = !t.disabled;
    pe.disabled = !pe.disabled;
    pv.disabled = !pv.disabled;
    c.disabled = !c.disabled;
    e.disabled = !e.disabled;
    i.disabled = !i.disabled;
    enviar.disabled = !enviar.disabled;
});