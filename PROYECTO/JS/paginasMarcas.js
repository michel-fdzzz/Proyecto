
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

    //muestra la info de las páginas 
    let spanPagina = document.createElement('span');
    spanPagina.textContent = 'Página ' + paginaActual + ' de ' + totalPaginas;
    paginacionContainer.appendChild(spanPagina);

    // Botón siguiente
    if (paginaActual < totalPaginas) {
        let btnSiguiente = document.createElement('a');
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


let boton_newsletter = document.querySelector('.boton-newsletter').addEventListener('click', function () {
    let correo = document.getElementById('Email').value;

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let responseText = this.responseText.trim();

            let insertado = JSON.parse(responseText);
            document.getElementById('Email').value = '';

            if (insertado) {
                mensajeAnadirNewsletter();
            } else {
                mensajeNoAnadirNewsletter();
            }
        }
    };
    xhttp.open("POST", "PHP/añadirNewsletter.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("correo=" + correo);
});



// Función para mostrar el mensaje
function mensajeAnadirNewsletter() {
    $('.container-mensajeAnadidoNewsletter').css('right', '-100%'); //coloca el mansaje fuera de la pantalla
    $('.container-mensajeAnadidoNewsletter').show().animate({
        right: '0' //Mueve el mensaje hasta ponerlo a right 0;
    }, 500);

    // Oculta el mansaje  después de 4 segundos
    setTimeout(function () {
        $('.container-mensajeAnadidoNewsletter').animate({
            right: '-100%'
        }, 500, function () {
            $(this).hide();
        });
    }, 4000);
}


function mensajeNoAnadirNewsletter() {
    $('.container-mensajeNoAnadidoNewsletter').css('right', '-100%');
    $('.container-mensajeNoAnadidoNewsletter').show().animate({
        right: '0'
    }, 500);

    // Oculta el mansaje  después de 4 segundos
    setTimeout(function () {
        $('.container-mensajeNoAnadidoNewsletter').animate({
            right: '-100%'
        }, 500, function () {
            $(this).hide();
        });
    }, 4000);
}

