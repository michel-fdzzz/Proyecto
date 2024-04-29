<?php

include('conexion.php');
session_start();

$idPedido = 1;
$idCliente = $_SESSION["idCliente"];

$con = new Conexion();
$con = $con->conectar();
$select = "select max(id) as id from pedido";
$restSelMax = $con->query($select);

if ($restSelMax->num_rows > 0) {
    $id = $restSelMax->fetch_assoc();
    $idPedido = $id['id'] + 1;
}

//Para hacer el num_rows y hacer un bucle que meta todos los productos en un mismo pedido con el mismo id
$select = "select * from carrito where idCliente = $idCliente";
$restSel = $con->query($select);
$array = $restSel->fetch_all();
$filas = $restSel->num_rows;



if ($filas > 0) {
    for ($i = 0; $i < $filas; $i++) {
        $idProducto = $array[$i][0];
        $nombreProducto = $array[$i][2];
        $modelo = $array[$i][3];
        $cantidad = $array[$i][4];
        $precio = $array[$i][5];
        $precioTotalPorProducto = $cantidad * $precio;
        $precio_envio = $precioTotalPorProducto * 0.01;
        $precioTotal = $precioTotalPorProducto + $precio_envio;

        $insert = "insert into pedido (id, idProducto, idCliente, nombreProducto, modelo ,cantidad, precio, fecha) 
        values ($idPedido," . $idProducto . ", " . $idCliente . ", '" . $nombreProducto . "', '" . $modelo . "', " . $cantidad . "," . $precioTotal . ", curdate())";
        $rest = $con->query($insert);

        if ($rest) {
            $delete = "delete from carrito where idProducto = '$idProducto' and idCliente = '$idCliente'";
            $rest = $con->query($delete);
        }
    }
}


