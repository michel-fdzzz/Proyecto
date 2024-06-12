<?php
include('conexion.php');

$idProducto = $_POST["idProducto"];
$idCliente = $_POST["idCliente"];
$nombreProducto = $_POST["nombreProducto"];
$modelo = $_POST['modelo'];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];

$respuesta = array();

$con = new Conexion();
$con = $con->conectar();

if ($con->connect_error) {
    $respuesta['success'] = false;
    $respuesta['message'] = 'Conexión fallida: ' . $con->connect_error;
} else {
    $select_stock = "SELECT * FROM producto WHERE stock >= $cantidad";
    $restSel = $con->query($select_stock);

    if ($restSel->num_rows > 0) {
        $select = "SELECT * FROM carrito WHERE idProducto = $idProducto AND idCliente = $idCliente";
        $restSel = $con->query($select);

        if ($restSel->num_rows <= 0) {
            $insert = "INSERT INTO carrito (idProducto, idCliente, nombreProducto, modelo, cantidad, precio) VALUES ($idProducto, $idCliente, '$nombreProducto', '$modelo', $cantidad, '$precio')";
            if ($con->query($insert) === TRUE) {
                $respuesta['success'] = true;
            } else {
                $respuesta['success'] = false;
            }
        } else {
            $respuesta['success'] = false;
        }
    } else {
        $respuesta['success'] = false;
    }
}
$con->close();

echo json_encode($respuesta);
?>
