var clickBtn = document.getElementById("mostrarocultos");
const boxes = document.querySelectorAll('.inactivo');

clickBtn.addEventListener('click', function(event) {
        boxes.forEach(function (elem) {
        if (elem.classList.contains("oculto")){
            elem.classList.remove('oculto');
        } else {
            elem.classList.add('oculto');
        }
    });
});