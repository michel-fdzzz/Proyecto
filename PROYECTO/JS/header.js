let body = document.querySelector('body');
let lupaContainer = document.querySelector('.lupa');
let lupaImagen = document.querySelector('.lupaImagen');
let busqueda = document.querySelector('.containerBusqueda');
busqueda = null; //para que no se quede vacía como tal y no de error
let menuTexto = document.querySelector('.menu');

lupaContainer.addEventListener('click', function () {
    // Eliminar cualquier contenedor de búsqueda existente
    let buscadoresAnteriores = document.querySelectorAll('.containerBusqueda');
    buscadoresAnteriores.forEach(function (buscador) {
        // Agregar clase para la transición de desaparición
        buscador.classList.add('cerrarBusqueda');
        // Eliminar el elemento después de la transición
        setTimeout(function () {
            buscador.remove();
        }, 200); // Tiempo de espera igual al tiempo de la transición
    });

    if (!busqueda) {
        let contenedor = document.querySelector('.buscadorContainer');
        busqueda = document.createElement('div');
        busqueda.setAttribute('class', 'containerBusqueda');
        let input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'buscador');
        input.setAttribute('id', 'buscador');
        input.setAttribute('placeholder', 'Buscar');
        busqueda.appendChild(input);
        contenedor.appendChild(busqueda);
        //Insertar el contenedor antes del formulario en el DOM
        // Encontrar el elemento con la clase .main
        let mainElement = document.querySelector('.main');
        // Insertar el contenedor de búsqueda antes del elemento .main
        mainElement.parentNode.insertBefore(contenedor, mainElement);

    } else {
        // Limpiar la referencia al contenedor de búsqueda existente
        busqueda = null;
    }
});





function desplegable() {
    var desplegable = document.querySelector(".containerDesplegable");

    //Si se está mostrando
    if (desplegable.classList.contains("mostrar")) {
        desplegable.style.display = "none";
        menuTexto.textContent = 'Menú';
        lupaImagen.src = 'imagenes/lupa.png';
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





//Funcion para abrir el sidebar del header
$(document).ready(function () {
    $('#menu-btn').click(function () {
        $('.sidebar').toggleClass('active');
    });
});
