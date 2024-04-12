let menuTexto = document.querySelector('.menu');

function desplegable() {
    var desplegable = document.querySelector(".containerDesplegable");

    //Si se está mostrando
    if (desplegable.classList.contains("mostrar")) {
        desplegable.style.display = "none";
        menuTexto.textContent = 'Menú';
        desplegable.classList.remove("mostrar");

        //Si no se muestra
    } else {
        desplegable.style.display = "block";
        menuTexto.textContent = 'Cerrar';
        desplegable.classList.add("mostrar");
        document.addEventListener('click', cerrarDesplegable);
    }
}

function cerrarDesplegable(event) {
    var desplegable = document.querySelector(".containerDesplegable");
    var button = document.querySelector(".botonDesplegar");

    //Si el click no se da en el área donde está el evento ni ha dado concretamente al botón. Se cierra el desplegable
    if (!desplegable.contains(event.target) && event.target !== button) {
        desplegable.style.display = "none";
        menuTexto.textContent = 'Menú';
        desplegable.classList.remove("mostrar");
        //document.removeEventListener('click', cerrarDesplegable);
    }
}
