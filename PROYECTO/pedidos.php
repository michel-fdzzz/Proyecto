<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="CSS/pedidos.css">
</head>

<body>
    <?php include 'header.php';
    $tabindex = 13;
    ?>
    <section class="main">
        <h1 class="tituloPedidos">Sus <br> pedidos</h1>


        <?php

        // Si la variable de sesión tiene valor es que el usuario a iniciado sesion o se ha registrado y puede ver el carrito y comprar productos
        if (isset($_SESSION['idCliente'])) {
            $con = new Conexion();
            $con = $con->conectar();

            $select = "select producto.imagen, pedido.nombreProducto, pedido.modelo, pedido.cantidad, pedido.precio, pedido.fecha, pedido.id
            from pedido
            inner join producto on producto.id = pedido.idProducto
            where pedido.idCliente = ? 
            order by pedido.fecha desc";
            $stmt = $con->prepare($select);

            if ($stmt) {
                $stmt->bind_param("i", $_SESSION['idCliente']);
                $stmt->execute();
                $rest = $stmt->get_result();

                if ($rest->num_rows > 0) {
                    $rows = $rest->fetch_all(MYSQLI_ASSOC); // Obtener todos los resultados como una matriz asociativa
                    echo '<article class="pedidos-container">';
                    foreach ($rows as $row) {
                        echo '
                        <div class="pedido">
                            <img class="pedido-imagen" src="imagenes/' . $row['imagen'] . '" alt="' . $row['modelo'] . ' ' . $row['nombreProducto'] . '" tabindex="' . $tabindex . '">';
                        $tabindex++;
                        echo ' <hr>
                            <p tabindex="' . $tabindex . '"><b>Código de pedido: ' . $row['id'] . '</b></p>';
                        $tabindex++;
                        echo '
                            <hr>
                            <p tabindex="' . $tabindex . '">' . $row['modelo'] . ' ' . $row['nombreProducto'] . '</p>';
                        $tabindex++;
                        echo '
                            <hr>
                            <p tabindex="' . $tabindex . '">Cantidad: ' . $row['cantidad'] . '</p>';
                        $tabindex++;
                        echo '
                            <hr>
                            <p tabindex="' . $tabindex . '">' . $row['precio'] . ' €</p>';
                        $tabindex++;
                        echo '
                            <hr>
                            <p tabindex="' . $tabindex . '">Pedido realizado: ' . $row['fecha'] . '</p>';
                        $tabindex++;
                        echo '
                        </div>';
                    }
                    echo '</article>';
                } else {
                    echo '
                        <div class="container-mensaje-pedidos">
                            <div class="mensajePredidos">
                                <p tabindex="' . $tabindex . '">No has hecho ningún pedido</p>';
                    $tabindex++;
                    echo '
                                <a class="linkMensaje" href="index.php" target="_self" tabindex="' . $tabindex . '" aria-label="Ver productos"><div class="botonVerProductos"><p>Ver productos</p></div></a>
                            </div>
                        </div>';
                }
                ?>



                </article>
                <?php
            } else {
                die('Error en la preparación de la consulta');
            }
            $con->close();
        } else {
            echo '
            <div class="mensaje">
                <p>No has iniciado sesión, registrate o inicia sesión para poder ver tus productos en el carrito.</p>
                <a class="linkMensaje" href="iniciarSesion.php" target="_self"><div class="boton"><p>Iniciar sesión/Registrarme</p></div></a>
            </div>';
        }


        ?>


    </section>
    <?php include 'footer.php'; ?>
</body>

</html>