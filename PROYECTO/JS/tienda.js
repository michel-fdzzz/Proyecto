
function añadirCarrito(idProducto, idCliente, nombreProducto, modelo, cantidad, precio) {
    // Solicitud AJAX
    var xhttp = new XMLHttpRequest();
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

    // Calcula el 70% de la altura de la ventana del navegador
    var seventyPercentHeight = window.innerHeight * 0.6;

    // Comprueba si la altura del contenido de la página es al menos el 70% de la altura de la ventana
    if (document.body.scrollHeight < seventyPercentHeight) {
        document.querySelector('footer').style.bottom = "0";
    }
});
