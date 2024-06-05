
function añadirCarrito(idProducto, idCliente, nombreProducto, modelo, cantidad, precio) {
    // Solicitud AJAX
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert('idProducto, idCliente, nombreProducto, modelo, cantidad, precio');
            document.getElementById('numProductos' + idProducto).value = '';
        }
    };
    xhttp.open("POST", "añadirCarrito.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&nombreProducto=" + nombreProducto + "&modelo=" + modelo + "&cantidad=" + cantidad + "&precio=" + precio);
}


// Poner que salte un mensaje de iniciar sesión o registrarte
function añadirSinUsuario() {
    let contenedor = document.createElement('div');
    let mensajeIniciarSesion = document.createElement('p');
    let link = document.createElement('button');
    alert('Debes iniciar sesion para añadir productos al carrito');
}


document.addEventListener("DOMContentLoaded", function () {

    // Calcula el 60% de la altura de la ventana del navegador
    let porcentaje_altura_pagina = window.innerHeight * 0.6;

    // Comprueba si la altura del contenido de la página es al menos el 60% de la altura de la ventana
    if (document.body.scrollHeight < porcentaje_altura_pagina) {
        document.querySelector('footer').style.bottom = "0";
    }
});

function mostrarProductos(productos, paginaActual, totalPaginas) {
    let containerProductos = document.querySelector('.productos-container');
    containerProductos.innerHTML = '';

    // Se muestran todos los productos de forma dinámica
    for (let producto of productos) {
        let producto_container = document.createElement('div');
        producto_container.classList.add('producto');

        let link_producto = document.createElement('a');
        link_producto.href = 'producto.php?idProducto=' + producto.id + '&nombreProducto=' + producto.nombre + '&modelo=' + producto.modelo + '&precio=' + producto.precio + '&imagen=' + producto.imagen + '&descripcion=' + producto.descripcion + '&stock=' + producto.stock;
        link_producto.target = '_blank';
        link_producto.className = 'link-producto';

        let img = document.createElement('img');
        img.setAttribute('src', 'imagenes/' + producto.imagen);
        img.setAttribute('width', '200em');
        img.setAttribute('height', '300em');
        img.setAttribute('class', 'producto-imagen');

        let nombre = document.createElement('h4');
        nombre.textContent = producto.nombre;

        let caracteristicas = document.createElement('p');
        caracteristicas.textContent = producto.descripcion;
        caracteristicas.setAttribute('class', 'grey');

        let precio = document.createElement('p');
        precio.textContent = producto.precio + ' €';

        producto_container.appendChild(img);
        producto_container.appendChild(nombre);
        producto_container.appendChild(caracteristicas);
        producto_container.appendChild(precio);
        link_producto.appendChild(producto_container);
        containerProductos.appendChild(link_producto);
    }

    // Crear los botones de paginación
    let paginacionContainer = document.querySelector('.container-botones-paginacion');
    paginacionContainer.innerHTML = '';

    // Botón anterior
    if (paginaActual > 1) {
        let btnAnterior = document.createElement('a');
        //let anteriorPagina = paginaActual - 1;
        btnAnterior.href = '#intro';
        let btnAnteriorTexto = document.createElement('button');
        btnAnteriorTexto.textContent = 'Anterior';
        btnAnteriorTexto.onclick = function () {
            buscar(document.querySelector('#buscador').value, paginaActual - 1);
        };
        btnAnterior.appendChild(btnAnteriorTexto);
        paginacionContainer.appendChild(btnAnterior);
    } else {
        let btnAnterior = document.createElement('button');
        btnAnterior.textContent = 'Anterior';
        btnAnterior.disabled = true;
        paginacionContainer.appendChild(btnAnterior);
    }

    // Información de la página actual
    let spanPagina = document.createElement('span');
    spanPagina.textContent = 'Página ' + paginaActual + ' de ' + totalPaginas;
    paginacionContainer.appendChild(spanPagina);

    // Botón siguiente
    if (paginaActual < totalPaginas) {
        let btnSiguiente = document.createElement('a');
        //let siguientePagina = paginaActual + 1;
        btnSiguiente.href = '#intro';
        let btnSiguienteTexto = document.createElement('button');
        btnSiguienteTexto.textContent = 'Siguiente';
        btnSiguienteTexto.onclick = function () {
            buscar(document.querySelector('#buscador').value, paginaActual + 1);
        };
        btnSiguiente.appendChild(btnSiguienteTexto);
        paginacionContainer.appendChild(btnSiguiente);
    } else {
        let btnSiguiente = document.createElement('button');
        btnSiguiente.textContent = 'Siguiente';
        btnSiguiente.disabled = true;
        paginacionContainer.appendChild(btnSiguiente);
    }
}
