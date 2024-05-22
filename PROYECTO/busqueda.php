<?php
include('conexion.php');
$input = isset($_POST['input']) ? $_POST['input'] : '';
$pagina = isset($_POST['pag']) ? intval($_POST['pag']) : 1;
$numElementos = 4;

$con = new Conexion();
$con = $con->conectar();
if ($con->connect_error) {
    die('Conexión fallida: ' . $con->connect_error);
} else {

    // Contar el total de productos que coinciden con la búsqueda
    $select = "SELECT COUNT(*) FROM producto WHERE nombre LIKE '$input%' OR marca LIKE '$input%'";
    
    $result = $con->query($select);
    $row = $result->fetch_row();
    $totalProductos = $row[0];
    //Estas tres líneas quivalen a esto:
    //$totalProductos = $con->query($select)->fetch_row()[0];

    $totalPaginas = ceil($totalProductos / $numElementos);

    //Obtenemos mediante el select los productos por página
    $num_productos_por_pagina = ($pagina - 1) * $numElementos;
    $select = "SELECT id, nombre, marca, modelo, precio, imagen, stock, descripcion FROM producto WHERE nombre LIKE '$input%' OR marca LIKE '$input%' LIMIT $num_productos_por_pagina, $numElementos";
    $rest = $con->query($select);

    if ($rest->num_rows > 0) {
        $productos = $rest->fetch_all(MYSQLI_ASSOC);
        echo json_encode([
            'productos' => $productos,
            'paginaActual' => $pagina,
            'totalPaginas' => $totalPaginas
        ]);
    } else {
        echo json_encode([
            'productos' => [],
            'paginaActual' => $pagina,
            'totalPaginas' => $totalPaginas
        ]);
    }
}
$con->close();
?>
