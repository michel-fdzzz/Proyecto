//Funcion para abrir y cerrar el buscador
$(document).ready(function () {
    $('.lupa').click(function () {
        $(this).closest('.menuPrincipal').find('.buscadorContainer').toggleClass('activo');
    });
});



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