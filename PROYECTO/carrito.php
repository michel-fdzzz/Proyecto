<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="CSS/carrito.css">
    <script defer src="JS/carrito.js"></script>
    <script defer src="JS/header.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <?php include('header.php');
    $precio_total = 0;
    //La sesion se inicia en el header
    ?>


    <div class='buscadorContainer'></div>
    <section class="main">
        <div class="container-mensajeStock">
            <div class="mensajeStock">
                <p>No puedes añadir más productos</p><img src='imagenes/X.svg' alt='X' />
            </div>
        </div>

        <h1 class="tituloCarrito">Su <br> Carrito</h1>


        <?php

        // Si la variable de sesión tiene valor es que el usuario a iniciado sesion o se ha registrado y puede ver el carrito y comprar productos
        if (isset($_SESSION['idCliente'])) {
            $con = new Conexion();
            $con = $con->conectar();

            $select = "select distinct carrito.nombreProducto, carrito.modelo, carrito.cantidad, carrito.precio, carrito.idProducto , producto.imagen, producto.stock
            from carrito
            inner join producto on producto.id = carrito.idProducto
            where carrito.idCliente = " . $_SESSION['idCliente'] . "";
            $rest = $con->query($select);
            $campos = $rest->fetch_all();
            $_SESSION['campos'] = $campos;

            if ($rest->num_rows > 0) {
                echo ' <article class="productos-carrito-container">
                    <div class="containerProductosCarrito">';
                    $precio_total = 0;
                foreach ($campos as $campo) {

                    $nombreProducto = $campo[0];
                    $modelo = $campo[1];
                    $cantidad = $campo[2];
                    $precio = $campo[3];
                    $idProducto = $campo[4];
                    $imagen = $campo[5];
                    $stock = $campo[6];

                    //Precio de un producto del carrito según sus respectivas unidades
                    $precio_total_producto = $precio * $cantidad;
                    //Acumulamos los precios de todos los productos en una sola variable
                    $precio_total += $precio_total_producto;
                   //El coste del envío es un 1%
                    $coste_envio_producto = $precio_total_producto * 0.01;

                    echo
                    "<div class='producto'>
                        <div class='info-producto-container'>
                            <div class='container-foto-botones'>
                                <div class='container-imagen'>
                                <img src='imagenes/" . $imagen . "' class='imagen-producto'/>
                                </div>
                                <button onclick=\"eliminarProducto(" . $idProducto . "," . $_SESSION['idCliente'] . ")\">Eliminar producto</button>
                                <button class='comprar' onclick=\"insertarPedido(" . $idProducto . "," . $_SESSION['idCliente'] . ",'" . $modelo . "'," . $cantidad . ", '" . $nombreProducto . "',$precio)\">Comprar</button>
                            </div> 
                            <div class='informacionCarrito'>
                                <div class='info'>
                                    <h3>$modelo " . $nombreProducto . "</h3>
                                    <p class='grey'>Precio unitario: " . $precio . "€</p>
                                    <p class='grey'>Unidades: <span class='unidadesEnCarrito" . $idProducto . "'>" . $cantidad . "</span></p>
                                    <p class='stock$idProducto' hidden>$stock</p>
                                    <p class='grey'>Gastos de envío: $coste_envio_producto € </p>
                                </div>
                                <div class='contenedorAnadirEliminar'>
                                    <button onclick=\"anadirUnidades(" . $idProducto . "," . $_SESSION['idCliente'] . ",document.querySelector('.unidades" . $idProducto . "').innerHTML, $cantidad, $stock)\">Añadir unidades</button>
                                    <button onclick=\"eliminarNumProducto(" . $idProducto . "," . $_SESSION['idCliente'] . ", document.querySelector('.unidades" . $idProducto . "').innerHTML, $cantidad)\">Eliminar unidades</button>
                                </div>
                            </div>
                        </div>
                        <div class='mas-menos-container'>
                            <div class='mas$idProducto' id='mas'><p>+</p></div>
                            <p class='unidades$idProducto'>0</p>
                            <div class='menos$idProducto' id='menos'><p>-</p></div>
                        </div>
                    </div>";
                }
                echo '</div>';

                //El 1% del precio del reloj
                $coste_envio = $precio_total * 0.01;
                $precio_total_envio =  $precio_total + $coste_envio;
        ?>
                <div class='container-comprar-todo-envio'>
                    <div class='comprar-todo-container'>
                        <div class='detalles-compra'>
                            <div class="valor-productos">
                                <p>Precio total</p>
                                <p><?php echo "$precio_total €"; ?></p>
                            </div>
                            <div class="coste-envio">
                                <p>Coste de envío</p>
                                <p><?php echo "$coste_envio €"; ?></p>
                            </div>
                            <hr class='linea-separadora'>
                            <div class="coste-IVA">
                                <p>Precio total y envío</p>
                                <p><?php echo "$precio_total_envio €"; ?></p>
                            </div>
                            <button onclick='comprarTodo(<?PHP echo $_SESSION["idCliente"] ?>)'>Comprar todo</button>
                        </div>
                    </div>

                    <div class='tiempo-envio'>
                        <p>Entrega en 4 - 9 días laborables</p>
                    </div>
                    <div>
                        </article>
                <?php
            } else {
                echo '
            <div class="container-mensajes">
                <div class="mensajeProductosCarrito">
                    <p>No hay productos en el carrito</p>
                    <a class="linkMensaje" href="tienda.php" target="_self"><div class="boton-mensaje"><p>Ver productos</p></div></a>
                </div>
            </div>    ';
            }
            $con->close();
        } else {
            echo  '
            <div class="container-mensajes">
            <div class="mensaje">
                <p>No has iniciado sesión, registrate o inicia sesión para poder ver tus productos en el carrito.</p>
                <a class="linkMensaje" href="iniciarSesion.php" target="_self"><div class="boton-mensaje"><p>Iniciar sesión/Registrarme</p></div></a>
            </div>
            </div>';
        }
                ?>


    </section>

    <?php
    include 'footer.php';
    ?>

    <script>
        <?php
        foreach ($_SESSION['campos'] as $campo) {
            $idProducto = $campo[4];
        ?>
            //Seleccionamos todos los elementos con la clase .mas y .menos
            let botonesMas<?php echo $idProducto; ?> = document.querySelectorAll('.mas<?php echo $idProducto; ?>');
            let botonesMenos<?php echo $idProducto; ?> = document.querySelectorAll('.menos<?php echo $idProducto; ?>');

            //Hacemos un bucle que itere en todos los botones y haga su función en el botón que se pulse, 
            //en este caso es decrementar la cantidad a añadir.
            botonesMas<?php echo $idProducto; ?>.forEach(function(botonMas) {
                botonMas.addEventListener('click', function() {
                    //Uds a eliminar/añadir
                    let cantidad = document.querySelector('.unidades<?php echo $idProducto; ?>');

                    //UDS en el carrito
                    let unidadesCarrito = document.querySelector('.unidadesEnCarrito<?php echo $idProducto; ?>');

                    let stock = document.querySelector('.stock<?php echo $idProducto; ?>');
                    if (cantidad.innerHTML < stock.innerHTML) {
                        cantidad.innerHTML = parseInt(cantidad.innerHTML) + 1;
                    }
                });
            });

            //Hacemos un bucle que itere en todos los botones y haga su función en el botón que se pulse, 
            //en este caso es decrementar la cantidad a eliminar.
            botonesMenos<?php echo $idProducto; ?>.forEach(function(botonMenos) {
                botonMenos.addEventListener('click', function() {
                    let cantidad = document.querySelector('.unidades<?php echo $idProducto; ?>');
                    if (parseInt(cantidad.innerHTML) > 0) {
                        cantidad.innerHTML = parseInt(cantidad.innerHTML) - 1;
                    }
                });
            });
        <?php } ?>

      
    </script>
</body>

</html>