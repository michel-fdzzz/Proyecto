


try {
    document.querySelector('.desconexion').addEventListener('click', function () {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log('Conexion hecha')
                window.location.href = "index.php";
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

function eliminarNumProducto(idProducto, idCliente, numProductos, cantidad) {
    // Solicitud AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = "carrito.php";
        }
    };
    xhttp.open("POST", "eliminarNumProducto.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&cantidad=" + cantidad + "&numProductos= " + numProductos);
}

function anadirUnidades(idProducto, idCliente, numProductos, cantidad, stock) {
    //Numero maximo que puedes añadir
    let productosA_anadir = stock - cantidad;
    //si el nº de productos a añadir es menor o igual
    if (numProductos <= productosA_anadir) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                window.location.href = "carrito.php";
            }
        };
        xhttp.open("POST", "anadirUnidades.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&numProductos= " + numProductos);
    } else {
        mensajeStock();
    }
}

function comprarTodo(idCliente) {
    // Solicitud AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert('Pedido realizado');
            window.location.href = "carrito.php";
        }
    };
    xhttp.open("POST", "comprarTodo.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("idCliente=" + idCliente);
}


// Función para mostrar la ventana modal
function mensajeStock() {
    $('.container-mensajeStock').css('right', '-100%'); // Coloca el mansaje  fuera de la pantalla
    $('.container-mensajeStock').show().animate({
        right: '0' // Mueve el mansaje  hacia la izquierda
    }, 500); // Duración de la animación en milisegundos

    // Oculta el mansaje  después de 3 segundos
    setTimeout(function () {
        $('.container-mensajeStock').animate({
            right: '-100%' // Mueve el mansaje  hacia la derecha para ocultarla
        }, 500, function () {
            $(this).hide(); // Oculta el mansaje  después de la animación
        });
    }, 5000); // Tiempo de espera en milisegundos antes de ocultar el mansaje 
}

/*
document.addEventListener("DOMContentLoaded", function () {

    // Calcula el 70% de la altura de la ventana del navegador
    var seventyPercentHeight = window.innerHeight * 0.6;

    // Comprueba si la altura del contenido de la página es al menos el 70% de la altura de la ventana
    if (document.body.scrollHeight < seventyPercentHeight) {
        document.querySelector('footer').style.bottom = "0";
    }
});
*/