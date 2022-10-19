// obtenemos los datos del boton y de todos los productos que esten ocultos
var clickBtn = document.getElementById("mostrarocultos");
const boxes = document.querySelectorAll('.inactivo');

// Al precionar el switch muestra los productos ocultos
// y guarda el estado en localStorage
function mostraroculto() {
    localStorage.setItem("mostrarocultos", mostrarocultos.checked);
    boxes.forEach(function (elem) {
        if (elem.classList.contains("oculto")){
            elem.classList.remove('oculto');
        } else {
            elem.classList.add('oculto');
        }
    });
};

// comprueba el valor del switch en localStorage al recargar la pagina
// para activar el switch en el caso de que estuviera activado al momento
// de recargar la pagina.
function isChecked() {
    if (localStorage.getItem('mostrarocultos') == 'true') {
        clickBtn.checked = localStorage.getItem('mostrarocultos') === 'true'
        mostraroculto();
    }
}

// al cargar la pagina ejecuta la funcion "isChecked"
window.onload = function() {
    isChecked();
};