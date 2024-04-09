<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="CSS/carrito.css">
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
            <div class="iconoInicioSesion">
                <a href="inicioSesion.php" target="_self">
                    <img src="imagenes/perfil-removebg-preview (1).png" width="29em" height="29em" alt="Carrito" />
                </a>
            </div>

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

        $con = new Conexion();
        $con = $con->conectar();
        $select = "select * from carrito";
        $rest = $con->query($select);
        $campos = $rest->fetch_all();
        if ($rest->num_rows > 0) {
            foreach ($campos as $campo) {
                echo
                "<div class='producto'>
        <img src='" . $campo[4] . "' width='200em' height='300em'/>
        <p class='bold'>" . $campo[1] . "</p>
        <p class='bold'>" . intval($campo[3]) . " €</p>
        Cantidad: <input type='number' id='numProductos" . $campo[0] . "' max='3' min='1' /><br>";

                if (isset($_SESSION['idCliente'])) {
                    echo "<button onclick=\"añadirCarrito(" . $campo[0] . "," . $_SESSION['idCliente'] . ",'" . $campo[1] . "',document.getElementById('talla" . $campo[0] . "').value , document.getElementById('numProductos" . $campo[0] . "').value,'" . $campo[2] . "')\">Añadir al carrito</button>";
                } else {
                    echo "<button onclick\"añadirSinUsuario()>Añadir al carrito</button>";
                }
                echo "</div>";
            }
        }

        ?>

    </article>

    <?php
    // Si la variable de sesión tiene valor es que el usuario a iniciado sesion o se ha registrado y puede ver el carrito y comprar productos
    if (isset($_SESSION['idCliente'])) {
        $_SESSION['precioTodo'] = 0;
        $con = new Conexion();
        $con = $con->conectar();

        $select = "select distinct nombreProducto, talla, cantidad, precio, idProducto from carrito where idCliente = " . $_SESSION['idCliente'] . "";
        $rest = $con->query($select);
        $campos = $rest->fetch_all();

        if ($rest->num_rows > 0) {
            echo '<div class="containerProductosCarrito">';
            foreach ($campos as $campo) {
                $precioTotalPorProducto = $campo[2] * $campo[3];
                $_SESSION['precioTodo'] = $_SESSION['precioTodo'] + $precioTotalPorProducto;

                $nombreProducto = $campo[0];
                $talla = $campo[1];
                $cantidad = $campo[2];
                $precio = $campo[3];
                $idProducto = $campo[4];

                echo
                "<div class='producto'>
                    <p>" . $nombreProducto . "</p>
                    <p>Talla: " . $talla . "</p>
                    <p>Cantidad: " . $cantidad . "</p>
                    <p>Precio unitario: " . $precio . "€</p>
                    <p>Precio total: " . $precioTotalPorProducto . "€</p>
                    Eliminar unidades: <input type='number' id='numEliminar" . $idProducto . $talla . "' name='numEliminar' max='3' min='1'/>
                    <button onclick=\"eliminarNumProducto(" . $idProducto . "," . $_SESSION['idCliente'] . "," . $talla . "," . $cantidad . ", document.getElementById('numEliminar" . $idProducto . $talla . "').value)\">Eliminar unidades</button>
                    <br> 
                    <button onclick=\"eliminarProducto(" . $idProducto . "," . $_SESSION['idCliente'] . "," . $talla . "," . $cantidad . ")\">Eliminar producto</button>
                    <button onclick=\"insertarPedido(" . $idProducto . "," . $_SESSION['idCliente'] . "," . $talla . "," . $cantidad . ", '" . $nombreProducto . "',$precio)\">Comprar</button>
                    </div>";
            }
            echo '</div>';
            echo "<button id='comprarTodo' onclick=\"comprarTodo(" . $_SESSION['idCliente'] . ")\">Comprar todo</button>";
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
                <p>No has iniciado sesión, registrate o inicia sesión para poder entrar en el carrito</p>
                <a class="linkMensaje" href="inicioSesion.php" target="_self"><div class="boton"><p>Iniciar sesión/Registrarme</p></div></a>
            </div>';
    }
    ?>

    <script defer src="JS/carrito.js">
    </script>
</body>

</html>