//Funcion para abrir y cerrar el buscador
$(document).ready(function () {
    $('.lupa').click(function () {
        $(this).closest('.menuPrincipal').find('.buscadorContainer').toggleClass('activo');
    });
});




function añadirCarrito(idProducto, idCliente, nombreProducto, modelo, cantidad, precio) {
    // Solicitud AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(idProducto + ', ' + idCliente + ', ' + nombreProducto + ', ' + modelo + ', ' + cantidad + ', ' + precio);

            document.getElementById('numProductos' + idProducto).value = '';
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

//Cerrar la ventana al hacer click en la X
$(document).ready(function () {
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