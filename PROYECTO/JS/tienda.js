


//Funcion para abrir y cerrar el buscador
$(document).ready(function () {
    $('.lupa').click(function () {

        $(this).closest('.menuPrincipal').find('.buscadorContainer').toggleClass('activo');

        function buscar(texto) {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Se controla que si introduces mal el nombre, salga un mensaje de que no se ha encontrado el producto que buscas pero salen los productos similares.
                    try {
                        console.log(this.responseText);
                        mostrarProductos(JSON.parse(this.responseText));
                    } catch {
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

                        div.appendChild(spanCerrar)
                        div.appendChild(p);
                        div.appendChild(gift);
                        main.appendChild(div);
                    }
                }
            };
            xhttp.open("POST", "busqueda.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("input=" + texto);
            return false;
        }

        // Según se escribe en el buscador se va recibiendo su valor
        let buscador = document.getElementById('buscador');
        buscador.addEventListener('input', function () {
            let texto = document.querySelector('#buscador').value;
            buscar(texto);
        });
    });
});

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

