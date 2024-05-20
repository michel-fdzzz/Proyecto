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
                window.location.href = "tienda.php";
            }
        };
        xhttp.open("POST", "desconectarse.php", true);
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


function mostrarProductos(productos) {
    console.log(productos);
    let containerProductos = document.querySelector('.productos-container');
    containerProductos.innerHTML = '';

    // Se muestran todos los productos de forma dinámica
    for (let producto of productos) {

        let producto_container = document.createElement('div');
        producto_container.classList.add('producto');

        let link_producto = document.createElement('a');
        link_producto.href = 'producto.php?idProducto=' + producto[0] + '&nombreProducto=' + producto[1] + '&modelo=' + producto[2] + '&precio=' + producto[4] + '&imagen=' + producto[5] + '&descripcion=' + producto[7] + '&stock=' + producto[6];
        link_producto.target = '_blank';
        link_producto.className = 'link-producto';

        let img = document.createElement('img');
        img.setAttribute('src', 'imagenes/' + producto[5] + '');
        img.setAttribute('width', '200em');
        img.setAttribute('height', '300em');
        img.setAttribute('class', 'producto-imagen');

        let nombre = document.createElement('h4');
        nombre.textContent = producto[2] + ' ' + producto[1];


        let caracteristicas = document.createElement('p');
        caracteristicas.textContent = '' + producto[7] + '';
        caracteristicas.setAttribute('class', 'grey');

        let precio = document.createElement('p');
        precio.textContent = producto[4] + ' €';


        link_producto.appendChild(producto_container);
        producto_container.appendChild(img);
        producto_container.appendChild(nombre);
        producto_container.appendChild(caracteristicas);
        producto_container.appendChild(precio);
        containerProductos.appendChild(link_producto);
    }
}

document.addEventListener('click', function (event) {
    //Si he hecho click en un elemnto con clase .cerrar se hace un bucle de todos los mensajeBusqueda y se eliminan
    if (event.target.classList.contains('cerrar')) {
        var mensajesBusqueda = document.querySelectorAll('.mensajeBusqueda');
        mensajesBusqueda.forEach(function (mensajeBusqueda) {
            mensajeBusqueda.remove();
        });
    }
});
