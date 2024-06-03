//Funcion para abrir y cerrar el buscador
$(document).ready(function () {
    $('.lupa').click(function () {
        $(this).closest('.menuPrincipal').find('.buscadorContainer').toggleClass('activo');
    });


    //Cerrar la ventana modal que sale indicando que inicies sesion
    $('.close').click(function () {
        $('#modal').fadeOut();
    });

    //Cerrar la ventana si se hace click fuera de la ventana
    $(window).click(function (event) {
        if ($(event.target).is('#modal')) {
            $('#modal').fadeOut();
        }
    });

    //Evento para redirigir al inicio de sesion
    $('#login-button').click(function () {
        window.location.href = 'iniciarSesion.php';
    });



});




function añadirCarrito(idProducto, idCliente, nombreProducto, modelo, cantidad, precio) {
    // Solicitud AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if (response.success) {
                mensajeAnadirCarrito();
            } else {
                mensajeNoAnadirCarrito();
            }
        }
    };
    xhttp.open("POST", "añadirCarrito.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&nombreProducto=" + nombreProducto + "&modelo=" + modelo + "&cantidad=" + cantidad + "&precio=" + precio);
}




// Función para mostrar la ventana modal
function añadirSinUsuario() {
    $('#modal').fadeIn();
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
