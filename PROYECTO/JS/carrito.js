




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



//
document.addEventListener("DOMContentLoaded", function () {
    // Verificar si el cuerpo supera el 100% de la altura de la pantalla
    if (document.body.scrollHeight > window.innerHeight) {
        // El cuerpo supera el 100% de la altura de la pantalla
        // Aplicar estilo al footer
        document.querySelector('footer').style.bottom = "0";
    } else {
        document.querySelector('footer').style.removeProperty('bottom');
    }
});