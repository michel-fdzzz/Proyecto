<?php
include('conexion.php');
$idProducto = $_POST["idProducto"];
$idCliente = $_POST["idCliente"];
$cantidad = $_POST["cantidad"];
$numProductos = $_POST['numProductos'];

$con = new Conexion();
$con = $con->conectar();
if ($con->connect_error) {
    die('Conexión fallida: ' . $con->connect_error);
} else {
    // Si la cantidad de unidades del producto del carrito es mayor que el numero de productos a eliminar, se hace un update restando ambas cantidades
    if ($cantidad > $numProductos) {
        $update = "update carrito set cantidad = cantidad - $numProductos where idProducto = '$idProducto' and idCliente = '$idCliente'";
        $rest = $con->query($update);

        // Si no se cumple la condición es que se pretende borrar el mismo número de unidades o más, por lo que se realiza un delete para borrar completamente el producto
    } else {
        $delete = "delete from carrito where idProducto = '$idProducto' and idCliente = '$idCliente'";
        echo $delete;
        $rest = $con->query($delete);
    }
}
$con->close();
