<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/carrito.css">
    <script defer src="JS/carrito.js">
    </script>
    <script defer src="JS/menuDesplegable.js">
    </script>
</head>

<body>
    <?php include('conexion.php');
    session_start();
    ?>
    <section class="menuPrincipal">
        <div class="desplegable">
            <button onclick="desplegable()" class="botonDesplegar"><img src="imagenes/menuLineas.png" width="40em" height="30em" alt="Menu" />
                <p class='menu'>Menú</p>
            </button>
            <div class="containerDesplegable">
                <a href="#">Opción 1</a>
                <a href="#">Opción 2</a>
                <a href="#">Opción 3</a>
            </div>
        </div>
        <!--<div class='containerMenuSecundario'>
        <img src="imagenes/menuLineas.webp" width="40em" height="30em" alt="Menu" /><p class='menu'>Menú</p>
    </div>-->
        <a href='tienda.php' target="_self"><img src="imagenes/logo.png" width="100em" height="100em" alt="Logo" /></a>

        <!--<div class='containerBuscador'>
        <input type="text" name="buscador" id='buscador' placeholder="Buscar" />
    </div>-->

        <div class="containerIconos">
            <?php
            if (isset($_SESSION['idCliente'])) {
                //Ponerle en el hover el subrayado que tenog en el 3 en raya
                echo '
                <img class="desconexion" src="imagenes/salida-de-incendios.png" width="25em" height="25em" alt="Carrito" />';
            } else {
                echo
                '<div class="iconoInicioSesion">
                    <a href="iniciarSesion.php" target="_self">
                        <img src="imagenes/perfil-removebg-preview (1).png" width="29em" height="29em" alt="Carrito" />
                    </a>
                </div>';
            }
            ?>

            <div class="lupa">
                <img class='lupaImagen' src="imagenes/lupa.png" width="25em" height="25em" alt="Carrito" />
            </div>

            <div class="carrito">
                <a href="carrito.php" target="_self">
                    <img src="imagenes/carrito.png" width="29em" height="29em" alt="Carrito" />
                </a>
            </div>
        </div>
    </section>

    <div class='buscadorContainer'></div>

    <h1 class="tituloCarrito">Su <br> Carrito</h1>

    <article class="productos-carrito-container">
        <?php
        // Si la variable de sesión tiene valor es que el usuario a iniciado sesion o se ha registrado y puede ver el carrito y comprar productos
        if (isset($_SESSION['idCliente'])) {
            $_SESSION['precioTodo'] = 0;
            $con = new Conexion();
            $con = $con->conectar();

            $select = "select distinct nombreProducto, modelo, cantidad, precio, idProducto from carrito where idCliente = " . $_SESSION['idCliente'] . "";
            $rest = $con->query($select);
            $campos = $rest->fetch_all();

            if ($rest->num_rows > 0) {
                echo '<div class="containerProductosCarrito">';
                foreach ($campos as $campo) {
                    $precioTotalPorProducto = $campo[2] * $campo[3];
                    $_SESSION['precioTodo'] = $_SESSION['precioTodo'] + $precioTotalPorProducto;

                    $nombreProducto = $campo[0];
                    $modelo = $campo[1];
                    $cantidad = $campo[2];
                    $precio = $campo[3];
                    $idProducto = $campo[4];

                    echo
                    "<div class='producto'>
                    <p>" . $nombreProducto . "</p>
                    <p>Modelo: " . $modelo . "</p>
                    <p>Cantidad: " . $cantidad . "</p>
                    <p>Precio unitario: " . $precio . "€</p>
                    <p>Precio total: " . $precioTotalPorProducto . "€</p>
                    <button onclick=\"insertarPedido(" . $idProducto . "," . $_SESSION['idCliente'] . ",'" . $modelo . "'," . $cantidad . ", '" . $nombreProducto . "',$precio)\">Comprar</button>
                    
                    </div><br>";
                }
                echo '</div>';
            } else {
                echo '
            <div class="mensajeProductosCarrito">
                <p>No hay productos en el carrito</p>
                <a class="linkMensaje" href="tienda.php" target="_self"><div class="botonVerProductos"><p>Ver productos</p></div></a>
            </div>';
            }
            $con->close();
        } else {
            echo  '
            <div class="mensaje">
                <p>No has iniciado sesión, registrate o inicia sesión para poder ver tus productos en el carrito.</p>
                <a class="linkMensaje" href="inicioSesion.php" target="_self"><div class="boton"><p>Iniciar sesión/Registrarme</p></div></a>
            </div>';
        }
        ?>


    </article>
</body>

</html>