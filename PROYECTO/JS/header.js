let body = document.querySelector('body');
let lupaContainer = document.querySelector('.lupa');
let lupaImagen = document.querySelector('.lupaImagen');
let busqueda = document.querySelector('.containerBusqueda');
busqueda = null; //para que no se quede vacía como tal y no de error
let menuTexto = document.querySelector('.menu');
let main = document.querySelector('.main');



try {
    document.querySelector('.desconexion').addEventListener('click', function () {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log('Conexion hecha')
                window.location.href = "index.php";
            }
        };
        xhttp.open("POST", "PHP/desconectarse.php", true);
        xhttp.send();
    });
} catch {
    console.log('La clase no existe porque no hay ningún id asociado a la variable de seison')
}




// Función para cambiar el texto del menú
function cambiarTextoMenu() {
    if (document.querySelector('.containerDesplegable').classList.contains('activo')) {
        menuTexto.textContent = 'Cerrar';
    } else {
        menuTexto.textContent = 'Menú';
    }
}

// Función que se ejecuta después de que el documento se ha cargado completamente
$(document).ready(function () {
    $('.botonDesplegar').click(function () {
        $(this).siblings('.containerDesplegable').toggleClass('activo');
        cambiarTextoMenu();
    });
    cambiarTextoMenu();
});



document.addEventListener('click', function (event) {
    //Si he hecho click en un elemnto con clase .cerrar se hace un bucle de todos los mensajeBusqueda y se eliminan
    if (event.target.classList.contains('cerrar')) {
        var mensajesBusqueda = document.querySelectorAll('.mensajeBusqueda');
        mensajesBusqueda.forEach(function (mensajeBusqueda) {
            mensajeBusqueda.remove();
        });
    }
});
