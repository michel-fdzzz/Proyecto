function eliminarProducto(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(id)
            window.location.href = "eliminar-productos-gestion.php";
        }
    };
    xhttp.open("POST", "PHP/eliminarProducto-gestion.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id);
}