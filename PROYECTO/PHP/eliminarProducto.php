<?php
include ('conexion.php');

$idProducto = $_POST["idProducto"];
$idCliente = $_POST["idCliente"];

$con = new Conexion();
$con = $con->conectar();

if ($con->connect_error) {
    die('Conexión fallida: ' . $con->connect_error);
} else {
    $delete = "delete from carrito where idProducto = '$idProducto' and idCliente = '$idCliente'";
    $rest = $con->query($delete);
}
$con->close();
?>