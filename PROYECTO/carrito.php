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
      //La sesion se inicia en el header y el archivo conexion.php se incluye también en el header
      $tabindex = 13;
    ?>


    <div class='buscadorContainer'></div>
    <section class="main">
       

        <h1 class="tituloCarrito" tabindex="<?php echo $tabindex;
        $tabindex++; ?>">Su <br> Carrito</h1>


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
                   //El coste del envío es un 0.01%
                    $coste_envio_producto = $precio_total_producto * 0.01;

                    echo
                    "<div class='producto'>
                        <div class='info-producto-container'>
                            <div class='container-foto-botones'>
                                <div class='container-imagen'>
                                <img src='imagenes/" . $imagen . "' alt='$modelo $nombreProducto' class='imagen-producto' tabindex='$tabindex'/>";
                                $tabindex++;

                                echo "
                                </div>
                                <button onclick=\"eliminarProducto(" . $idProducto . "," . $_SESSION['idCliente'] . ")\" tabindex='$tabindex' aria-label='Botón eliminar el $modelo $nombreProducto'>Eliminar producto</button>";
                                $tabindex++;
                                echo "
                                <button class='comprar' onclick=\"insertarPedido(" . $idProducto . "," . $_SESSION['idCliente'] . ",'" . $modelo . "'," . $cantidad . ", '" . $nombreProducto . "',$precio)\" tabindex='$tabindex' aria-label='Botón comprar el $modelo $nombreProducto'>Comprar</button>
                            </div>";
                            $tabindex++;
                            echo "
                            <div class='informacionCarrito'>
                                <div class='info'>
                                    <h3 tabindex='$tabindex'>$modelo " . $nombreProducto . "</h3>";
                                $tabindex++;
                                echo "
                                    <p class='grey' tabindex='$tabindex'>Precio unitario: " . $precio . "€</p>";
                                $tabindex++;
                                echo "
                                    <p class='grey' tabindex='$tabindex'>Unidades: <span class='unidadesEnCarrito" . $idProducto . "'>" . $cantidad . "</span></p>";
                                $tabindex++;
                                echo "
                                    <p class='stock$idProducto' hidden>$stock</p>
                                    <p class='grey' tabindex='$tabindex'>Gastos de envío: $coste_envio_producto € </p>";
                                $tabindex++;
                                echo "
                                </div>
                                <div class='contenedorAnadirEliminar'>
                                    <button onclick=\"anadirUnidades(" . $idProducto . "," . $_SESSION['idCliente'] . ",document.querySelector('.unidades" . $idProducto . "').innerHTML, $cantidad, $stock)\" tabindex='$tabindex' aria-label='Botón para añadir las unidades sumadas en los botones de incremento y decremento de $modelo $nombreProducto'>Añadir unidades</button>";
                                $tabindex++;
                                echo "
                                    <button onclick=\"eliminarNumProducto(" . $idProducto . "," . $_SESSION['idCliente'] . ", document.querySelector('.unidades" . $idProducto . "').innerHTML, $cantidad)\" tabindex='$tabindex' aria-label='Botón para Eliminar las unidades sumadas en los botones de incremento y decremento de $modelo $nombreProducto'>Eliminar unidades</button>";
                                $tabindex++;
                                echo "
                                </div>
                            </div>
                        </div>
                        <div class='mas-menos-container'>
                            <div class='mas$idProducto' id='mas' tabindex='$tabindex' aria-label='Botón para incrementar las unidades a eliminar de $modelo $nombreProducto'><p>+</p></div>";
                                $tabindex++;
                                echo "
                            <p class='unidades$idProducto'>0</p>
                            <div class='menos$idProducto' id='menos' tabindex='$tabindex' aria-label='Botón para decrementar las unidades a eliminar de $modelo $nombreProducto'><p>-</p></div>
                        </div>
                    </div>";
                    $tabindex++;
                }
                echo '</div>';

                //El 0,01% del precio del reloj
                $coste_envio = $precio_total * 0.01;
                $precio_total_envio =  $precio_total + $coste_envio;
        ?>
                <div class='container-comprar-todo-envio'>
                    <div class='comprar-todo-container'>
                        <div class='detalles-compra'>
                            <div class="valor-productos">
                                <p tabindex="<?php echo $tabindex;
        $tabindex++; ?>" aria-label="Precio total de todo el carrito">Precio total</p>

                                <p tabindex="<?php echo $tabindex;
        $tabindex++; ?>"><?php echo "$precio_total €"; ?></p>

                            </div>
                            <div class="coste-envio">
                                <p tabindex="<?php echo $tabindex;
        $tabindex++; ?>">Coste de envío</p>
                                <p tabindex="<?php echo $tabindex;
        $tabindex++; ?>"><?php echo "$coste_envio €"; ?></p>

                            </div>
                            <hr class='linea-separadora'>
                            <div class="coste-IVA">
                                <p tabindex="<?php echo $tabindex;
        $tabindex++; ?>">Precio total y envío</p>

                                <p tabindex="<?php echo $tabindex;
        $tabindex++; ?>"><?php echo "$precio_total_envio €"; ?></p>

                            </div>
                            <button onclick='comprarTodo(<?PHP echo $_SESSION["idCliente"] ?>)' tabindex="<?php echo $tabindex;
        $tabindex++; ?>">Comprar todo</button>
                        </div>
                    </div>

                    <div class='tiempo-envio'>
                        <p tabindex="<?php echo $tabindex;
        $tabindex++; ?>">Entrega en 4 - 9 días laborables</p>
                    </div>
                    <div>
                        </article>
                <?php
            } else {
                echo '
            <div class="container-mensajes">
                <div class="mensajeProductosCarrito">
                    <p tabindex="'.$tabindex.'">No hay productos en el carrito</p>';
                    $tabindex++;
                    echo '
                    <a class="linkMensaje" href="index.php" target="_self"  tabindex="'.$tabindex.'" aria-label="Botón para ver los productos"><div class="boton-mensaje"><p>Ver productos</p></div></a>
                </div>
            </div>    ';
            }
            $con->close();
        } else {
            echo  '
            <div class="container-mensajes">
            <div class="mensaje">
                <p tabindex="'.$tabindex.'">No has iniciado sesión, registrate o inicia sesión para poder ver tus productos en el carrito.</p>';
                    $tabindex++;
                    echo '
                <a class="linkMensaje" href="iniciarSesion.php" target="_self" tabindex="'.$tabindex.'" aria-label="Botón para iniciar sesión o registrarte"><div class="boton-mensaje"><p>Iniciar sesión/Registrarme</p></div></a>
            </div>
            </div>';
        }
                ?>


    </section>

    <div class="container-mensajeProcesandoPedido">
        <div class="mensajeProcesandoPedido">
            <p>Pedido realizado</p><img src='imagenes/check.svg' alt='check' />
        </div>
    </div>


    <div class="container-mensajeEliminandoProducto">
        <div class="mensajeEliminandoProducto">
            <p>Eliminando producto...</p>
        </div>
    </div>

    <div class="container-mensajeStock">
            <div class="mensajeStock">
                <p>No puedes añadir más unidades</p><img src='imagenes/X.svg' alt='X' />
            </div>
        </div>

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