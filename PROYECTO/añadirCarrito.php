<?php
include('conexion.php');

$idProducto = $_POST["idProducto"];
$idCliente = $_POST["idCliente"];
$nombreProducto = $_POST["nombreProducto"];
$modelo = $_POST['modelo'];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];

echo $idProducto;
echo $idCliente;
echo $nombreProducto;
echo $modelo;
echo $cantidad;
echo $precio;


$con = new Conexion();
$con = $con->conectar();

if ($con->connect_error) {
    die('Conexión fallida: ' . $con->connect_error);
} else {
    // La idea es que no puedas añadir exactamente el mismo producto más de una vez, es decir, una zapatilla con una 
    // talla determinada es un producto diferente a esa misma zapatilla de diferente talla, pero si la talla es la misma 
    // y el producto es el mismo, no puedes incluirlo en el carrito.
    $select = "select idProducto from carrito 
    where idProducto = $idProducto";
    $restSel = $con->query($select);

    if ($restSel->num_rows <= 0) {
        $insert = "insert into carrito 
            values ($idProducto, $idCliente, '$nombreProducto', '$modelo' ,$cantidad,'$precio')";
        $rest = $con->query($insert);
    }
}
$con->close();
