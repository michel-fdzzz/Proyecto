//Funcion para abrir y cerrar el buscador
$(document).ready(function () {
    $('.lupa').click(function () {
        $(this).closest('.menuPrincipal').find('.buscadorContainer').toggleClass('activo');
    });


    //Cerrar la ventana modal que sale indicando que inicies sesion
    $('.close').click(function () {
        $('#container-mensajeIniciarSesion').fadeOut();
    });

    //Cerrar la ventana si se hace click fuera de la ventana
    $(window).click(function (event) {
        if ($(event.target).is('#container-mensajeIniciarSesion')) {
            $('#container-mensajeIniciarSesion').fadeOut();
        }
    });

    //Evento para redirigir al inicio de sesion
    $('#login-button').click(function () {
        window.location.href = 'iniciarSesion.php';
    });



});




function añadirCarrito(idProducto, idCliente, nombreProducto, modelo, cantidad, precio) {
    // Solicitud AJAX
    if (cantidad > 0) {
        var xhttp = new XMLHttpRequest();
        let numProductos = document.getElementById('numProductos' + idProducto);
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    mensajeAnadirCarrito();
                    numProductos.textContent = 0;
                } else {
                    mensajeNoAnadirCarrito();
                    numProductos.textContent = 0;
                }
            }
        };
        xhttp.open("POST", "PHP/añadirCarrito.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&nombreProducto=" + nombreProducto + "&modelo=" + modelo + "&cantidad=" + cantidad + "&precio=" + precio);
    }
}




// Función para mostrar la ventana modal
function añadirSinUsuario() {
    $('#container-mensajeIniciarSesion').fadeIn();
}

// Función para mostrar la ventana modal
function mensajeAnadirCarrito() {
    $('.container-mensajeAnadidoCarrito').css('right', '-100%'); // Coloca el mansaje  fuera de la pantalla
    $('.container-mensajeAnadidoCarrito').show().animate({
        right: '0' // Mueve el mansaje  hacia la izquierda
    }, 500); // Duración de la animación en milisegundos

    // Oculta el mansaje  después de 3 segundos
    setTimeout(function () {
        $('.container-mensajeAnadidoCarrito').animate({
            right: '-100%' // Mueve el mansaje  hacia la derecha para ocultarla
        }, 500, function () {
            $(this).hide(); // Oculta el mansaje  después de la animación
        });
    }, 5000); // Tiempo de espera en milisegundos antes de ocultar el mansaje 
}

function mensajeNoAnadirCarrito() {
    $('.container-mensajeNoAnadidoCarrito').css('right', '-100%'); // Coloca el mansaje  fuera de la pantalla
    $('.container-mensajeNoAnadidoCarrito').show().animate({
        right: '0' // Mueve el mansaje  hacia la izquierda
    }, 500); // Duración de la animación en milisegundos

    // Oculta el mansaje  después de 3 segundos
    setTimeout(function () {
        $('.container-mensajeNoAnadidoCarrito').animate({
            right: '-100%' // Mueve el mansaje  hacia la derecha para ocultarla
        }, 500, function () {
            $(this).hide(); // Oculta el mansaje  después de la animación
        });
    }, 5000); // Tiempo de espera en milisegundos antes de ocultar el mansaje 
}
