<?php
include ('conexion.php');
$idProducto = $_POST["idProducto"];
$idCliente = $_POST["idCliente"];
$cantidad = $_POST["cantidad"];//Las unidades que hay
$numProductos = $_POST['numProductos'];//Las que se quieren añadir

$con = new Conexion();
$con = $con->conectar();
if ($con->connect_error) {
    die('Conexión fallida: ' . $con->connect_error);
} else {

    $update = "update carrito set cantidad = cantidad + $numProductos where idProducto = '$idProducto' and idCliente = '$idCliente'";
    $rest = $con->query($update);
}
$con->close();
