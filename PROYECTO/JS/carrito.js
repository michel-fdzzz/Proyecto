

//Desconectarse de la sesión 'log out'
try {
    document.querySelector('.desconexion').addEventListener('click', function () {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = "index.php";
            }
        };
        xhttp.open("POST", "PHP/desconectarse.php", true);
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
            mensajeProcesandoPedido();
            setTimeout(function () {
                window.location.href = "carrito.php";
            }, 2000);
        }
    };
    xhttp.open("POST", "PHP/insertarPedido.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&modelo=" + modelo + "&cantidad=" + cantidad + '&nombreProducto=' + nombreProducto + ' &precio=' + precio);
}

function eliminarProducto(idProducto, idCliente) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            mensajeEliminandoProducto();
            setTimeout(function () {
                window.location.href = "carrito.php";
            }, 3000);
        }
    };
    xhttp.open("POST", "PHP/eliminarProducto.php", true);
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
    xhttp.open("POST", "PHP/eliminarNumProducto.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&cantidad=" + cantidad + "&numProductos= " + numProductos);
}

function anadirUnidades(idProducto, idCliente, numProductos, cantidad, stock) {
    //Numero maximo que puedes añadir
    let productosA_anadir = stock - cantidad;
    if (numProductos <= productosA_anadir) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = "carrito.php";
            }
        };
        xhttp.open("POST", "PHP/anadirUnidades.php", true);
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
            mensajeProcesandoPedido();
            setTimeout(function () {
                window.location.href = "carrito.php";
            }, 2000);
        }
    };
    xhttp.open("POST", "PHP/comprarTodo.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("idCliente=" + idCliente);
}


// Función para mostrar el mensaje
function mensajeStock() {
    $('.container-mensajeStock').css('right', '-100%');
    $('.container-mensajeStock').show().animate({
        right: '0' //Mueve el mansaje  hacia la izquierda para que se quede pegado a la derecha
    }, 500);

    // Oculta el mansaje  después de 5 segundos
    setTimeout(function () {
        $('.container-mensajeStock').animate({
            right: '-100%' // Mueve el mansaje  hacia la derecha para ocultarla
        }, 500, function () {
            $(this).hide();
        });
    }, 5000);
}


// Función para mostrar el mensaje
function mensajeProcesandoPedido() {
    $('.container-mensajeProcesandoPedido').css('right', '-100%');
    $('.container-mensajeProcesandoPedido').show().animate({
        right: '0' //Mueve el mansaje  hacia la izquierda para que se quede pegado a la derecha
    }, 300);
}


function mensajeEliminandoProducto() {
    $('.container-mensajeEliminandoProducto').css('right', '-100%');
    $('.container-mensajeEliminandoProducto').show().animate({
        right: '0' //Mueve el mansaje  hacia la izquierda para que se quede pegado a la derecha
    }, 300);
}

