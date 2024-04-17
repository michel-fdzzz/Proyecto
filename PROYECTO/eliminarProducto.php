    <?php
    include('conexion.php');

    $idProducto = $_POST["idProducto"];
    $idCliente = $_POST["idCliente"];

    $con = new Conexion();
    $con = $con->conectar();

    if ($con->connect_error) {
        die('Conexión fallida: ' . $con->connect_error);
        //SI la conexión con la base de datos no ha fallado, se borra el producto del carrito
    } else {
        $delete = "delete from carrito where idProducto = '$idProducto' and idCliente = '$idCliente'";
        echo $delete;
        $rest = $con->query($delete);
    }
    $con->close();
    ?>