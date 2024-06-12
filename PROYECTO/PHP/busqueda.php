<?php
include ('conexion.php');
$input = isset($_POST['input']) ? $_POST['input'] : '';
$pagina = isset($_POST['pag']) ? intval($_POST['pag']) : 1;
$numElementos = 4;

$con = new Conexion();
$con = $con->conectar();
if ($con->connect_error) {
    die('Conexión fallida: ' . $con->connect_error);
} else {

    //Contar el total de productos que coinciden con la búsqueda
    $select_num_productos = "SELECT COUNT(*) FROM producto WHERE nombre LIKE ? OR marca LIKE ?";
    $stmt_num_productos = $con->prepare($select_num_productos);
    $input = "$input%";
    $stmt_num_productos->bind_param("ss", $input, $input);
    $stmt_num_productos->execute();
    $stmt_num_productos->bind_result($totalProductos);
    $stmt_num_productos->fetch();
    $stmt_num_productos->close();

    $totalPaginas = ceil($totalProductos / $numElementos);

    //Obtenemos mediante el select los productos de la página en la que se va buscar
    //En está variable obtenemos el número de fila desde el que empezamos a mostrar los productos
    $num_fila_aPartir_muestra = ($pagina - 1) * $numElementos;
    $select_productos = "SELECT id, nombre, marca, modelo, precio, imagen, stock, descripcion 
    FROM producto WHERE nombre LIKE ? OR marca LIKE ? LIMIT ?, ?";
    $stmt_productos = $con->prepare($select_productos);
    $stmt_productos->bind_param("ssii", $input, $input, $num_fila_aPartir_muestra, $numElementos);
    $stmt_productos->execute();
    $rest = $stmt_productos->get_result();

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