<?php

include('conexion.php');
session_start();

$idProducto = $_POST["idProducto"];
$idCliente = $_POST["idCliente"];
$nombreProducto = $_POST['nombreProducto'];
$precio = $_POST['precio'];
$modelo = $_POST['modelo'];
$cantidad = $_POST["cantidad"];

$precioTotalPorProducto = $cantidad * $precio;
$precio_envio = $precioTotalPorProducto * 0.01;
$precioTotal = $precioTotalPorProducto + $precio_envio;
$idPedido = 1;

$con = new Conexion();
$con = $con->conectar();

$select = "select max(id) as id from pedido";
$restSelMax = $con->query($select);

// AL id máximo que devuelve le sumamos 1 para que sea otro pedido diferente
if ($restSelMax->num_rows > 0) {
    $id = $restSelMax->fetch_assoc();
    $idPedido = $id['id'] + 1;
}

$insert = "insert into pedido (id, idProducto, idCliente, nombreProducto, modelo ,cantidad, precio, fecha) 
    values ($idPedido," . $idProducto . ", " . $idCliente . ", '" . $nombreProducto . "', '" . $modelo . "', " . $cantidad . "," . $precioTotal . ", curdate())";
$rest = $con->query($insert);

// Si se ha insertado correctamente eliminamos el producto del carrito
if ($rest) {
    $delete = "delete from carrito where idProducto = '$idProducto' and modelo = '$modelo' and idCliente = '$idCliente'";
    $rest = $con->query($delete);

    $update = "update producto set stock = stock - $cantidad where id = $idProducto";
    $rest = $con->query($update);
}
