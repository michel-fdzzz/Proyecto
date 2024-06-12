
$(document).ready(function () {

    //Para que al darle a la lupa se muestre el buscador
    $('.lupa').click(function () {
        $(this).closest('.menuPrincipal').find('.buscadorContainer').toggleClass('activo');
    });


    //Cerrar el mensaje modal que sale indicando que inicies sesion
    $('.close').click(function () {
        $('#container-mensajeIniciarSesion').fadeOut();
    });

    //Cerrar el mensaje si se hace click fuera de el
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
                //Si devuelve true
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




// Función para mostrar el mensaje modal
function añadirSinUsuario() {
    $('#container-mensajeIniciarSesion').fadeIn();
}

// Función para mostrar el mensaje
function mensajeAnadirCarrito() {
    $('.container-mensajeAnadidoCarrito').css('right', '-100%');
    $('.container-mensajeAnadidoCarrito').show().animate({
        right: '0'
    }, 500);

    // Oculta el mansaje  después de 5 segundos
    setTimeout(function () {
        $('.container-mensajeAnadidoCarrito').animate({
            right: '-100%'
        }, 500, function () {
            $(this).hide();
        });
    }, 5000);
}

function mensajeNoAnadirCarrito() {
    $('.container-mensajeNoAnadidoCarrito').css('right', '-100%');
    $('.container-mensajeNoAnadidoCarrito').show().animate({
        right: '0'
    }, 500);

    //Oculta el mansaje  después de 5 segundos
    setTimeout(function () {
        $('.container-mensajeNoAnadidoCarrito').animate({
            right: '-100%'
        }, 500, function () {
            $(this).hide();
        });
    }, 5000);
}
