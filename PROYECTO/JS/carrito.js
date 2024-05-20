

//Funcion para abrir y cerrar el buscador
$(document).ready(function () {
    $('.lupa').click(function () {
        $(this).closest('.menuPrincipal').find('.buscadorContainer').toggleClass('activo');
    });
});




try {
    document.querySelector('.desconexion').addEventListener('click', function () {
        var xhttp = new XMLHttpRequest();
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


function insertarPedido(idProducto, idCliente, modelo, cantidad, nombreProducto, precio) {
    // Solicitud AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert('Pedido realizado');
            window.location.href = "carrito.php";
        }
    };
    xhttp.open("POST", "insertarPedido.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&modelo=" + modelo + "&cantidad=" + cantidad + '&nombreProducto=' + nombreProducto + ' &precio=' + precio);
}

function eliminarProducto(idProducto, idCliente) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = "carrito.php";
        }
    };
    xhttp.open("POST", "eliminarProducto.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente);
}



document.addEventListener("DOMContentLoaded", function () {

    // Calcula el 70% de la altura de la ventana del navegador
    var seventyPercentHeight = window.innerHeight * 0.6;

    // Comprueba si la altura del contenido de la página es al menos el 70% de la altura de la ventana
    if (document.body.scrollHeight < seventyPercentHeight) {
        document.querySelector('footer').style.bottom = "0";
    }
});
