function eliminarProducto(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = "eliminar-productos-gestion.php";
        }
    };
    xhttp.open("POST", "PHP/eliminarProducto-gestion.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id);
}


function eliminarUsuario(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = "eliminar-usuarios-gestion.php";
        }
    };
    xhttp.open("POST", "PHP/eliminarUsuario-gestion.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id);
}

function cambiar_tipo_usuario(id, tipo) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = "eliminar-usuarios-gestion.php";
        }
    };
    xhttp.open("POST", "PHP/cambiarUsuario-gestion.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id + '&tipo=' + tipo);
}


document.addEventListener("DOMContentLoaded", function () {
    // Verificar si el cuerpo supera el 100% de la altura de la pantalla
    if (document.body.scrollHeight < window.innerHeight) {
        document.querySelector('footer').style.bottom = "0";
    }
});
