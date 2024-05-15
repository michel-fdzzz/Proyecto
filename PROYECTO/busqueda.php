<?php
include('conexion.php');
$input = $_POST['input'];
$con = new Conexion();
$con = $con->conectar();
if ($con->connect_error) {
    die('Conexión fallida: ' . $con->connect_error);
} else {
    // Busca los productos que empiezan por $input y si devuelve algo lo 
    // guardamos en $fila en forma de array y lo enviamos como respuesta para 
    // que la función mostrarProductos() muestre los productos devueltos en el select
    $select = "select id,nombre, marca, modelo, precio, imagen, stock, descripcion from producto where nombre like '$input%' or marca like '$input%'";
    $rest = $con->query($select);
    if ($rest->num_rows > 0) {
        $fila = $rest->fetch_all();
        echo json_encode($fila);
    } else {
        return json_encode(array());
    }
}
$con->close();
