
function buscar(texto, pagina = 1) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            let response = JSON.parse(this.responseText);
            console.log(response);
            /**
             * Dividimos la respuesta en 3 partes de las cuales ya está compuesta. 
             * productos: array con la informacion del producto
             * paginaActual: valor de la página en la que estmaos
             * totalPaginas: el numero de páginas totales
             */
            mostrarProductos(response.productos, response.paginaActual, response.totalPaginas);

            if (response.productos.length == 0) {
                let main = document.querySelector('.main');
                let div = document.createElement('div');
                div.setAttribute('class', 'mensajeBusqueda');
                let spanCerrar = document.createElement("span");
                spanCerrar.textContent = "\u00D7";
                spanCerrar.classList.add("cerrar");
                let p = document.createElement('p');
                p.innerHTML = 'No se han encontrado resultados';
                let gift = document.createElement('img');
                gift.setAttribute('class', 'gift');
                gift.setAttribute('src', 'imagenes/gif_resultados.gif');
                div.appendChild(spanCerrar);
                div.appendChild(p);
                div.appendChild(gift);
                main.appendChild(div);

                //Si se pulsa fuera del contenedor, se borra
                $(document).on('click', function (event) {
                    if (!$(event.target).closest('.mensajeBusqueda').length) {
                        $(div).remove();
                    }
                });
            }
        }
    };
    xhttp.open("POST", "PHP/busqueda.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("input=" + texto + "&pag=" + pagina);
    return false;
}


//Funcion para abrir y cerrar el buscador
$(document).ready(function () {

    $('.lupa').click(function () {

        $(this).closest('.menuPrincipal').find('.buscadorContainer').toggleClass('activo');

        //Según se escribe en el buscador se va recibiendo su valor
        let buscador = document.getElementById('buscador');
        buscador.setAttribute('tabindex', '13');
        buscador.addEventListener('input', function () {
            let texto = document.querySelector('#buscador').value;
            buscar(texto);
        });

    });

});

//Evento para añadir el correo recogido del campo email al newsletter
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



//Función para mostrar el mensaje
function mensajeAnadirNewsletter() {
    $('.container-mensajeAnadidoNewsletter').css('right', '-100%');
    $('.container-mensajeAnadidoNewsletter').show().animate({
        right: '0'
    }, 500);

    //Oculta el mansaje  después de 4 segundos
    setTimeout(function () {
        $('.container-mensajeAnadidoNewsletter').animate({
            right: '-100%' //Mueve el mansaje a la derecha para ocultarlo
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

    //Oculta el mansaje  después de 4 segundos
    setTimeout(function () {
        $('.container-mensajeNoAnadidoNewsletter').animate({
            right: '-100%'
        }, 500, function () {
            $(this).hide();
        });
    }, 4000);
}



function mostrarProductos(productos, paginaActual, totalPaginas) {
    let containerProductos = document.querySelector('.productos-container');
    containerProductos.innerHTML = '';

    //Se muestran todos los productos de forma dinámica
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


    let paginacionContainer = document.querySelector('.container-botones-paginacion');
    paginacionContainer.innerHTML = '';

    //Botón anterior
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

    //Botón siguiente
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


let container = document.querySelector('.productos-exclusivos-container');
let pixeles_desplazamiento = 0;
let movimientoScroll = 16 * 16; //16 em que mide mi contenedor por 16px que corresponde a cada em, es una conversión
let segundos = 5000;
let scrollAutomaticoActivado = true;

function scrollAutomatico() {
    if (scrollAutomaticoActivado) {
        pixeles_desplazamiento += movimientoScroll;
        /**
         * Si llega al final. Ya que la resta
         * container.scrollWidth: contenido total del contenedor
         * container.clientWidth: contenido total del contenedor visible, lo que los usuarios ven
         */
        if (pixeles_desplazamiento >= container.scrollWidth - container.clientWidth) {
            pixeles_desplazamiento = 0;
        }

        //El scroll lo hacia a la izquierda con una transición (smooth)
        container.scrollTo({
            left: pixeles_desplazamiento,
            behavior: 'smooth'
        });
    }
}

//Cada 5 segundos ejecutamos el scroll
let scrollInterval = setInterval(scrollAutomatico, segundos);

//Si se interactúa con la barra de scroll, el scroll automático se desactiva mientras este pulsando la barra
container.addEventListener('mousedown', function () {
    scrollAutomaticoActivado = false;
});
//Si se suelta la barra de scroll se vuelve a activar el scroll automático continuando por donde lo había dejado
container.addEventListener('mouseup', function () {
    scrollAutomaticoActivado = true;
});
