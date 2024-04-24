<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/carrito.css">
    <script defer src="JS/carrito.js"></script>
    <script defer src="JS/header.js"></script>
    <script defer src="JS/menuDesplegable.js"></script>
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
        <a href='tienda.php' target="_self"><img src="imagenes/logo.png" width="100em" height="100em" alt="Logo" /></a>


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
    <section class="main">
        <h1 class="tituloCarrito">Su <br> Carrito</h1>

        <article class="productos-carrito-container">
            <?php
            // Si la variable de sesión tiene valor es que el usuario a iniciado sesion o se ha registrado y puede ver el carrito y comprar productos
            if (isset($_SESSION['idCliente'])) {
                $_SESSION['precioTodo'] = 0;
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
                    echo '<div class="containerProductosCarrito">';
                    foreach ($campos as $campo) {
                        $precioTotalPorProducto = $campo[2] * $campo[3];
                        $_SESSION['precioTodo'] = $_SESSION['precioTodo'] + $precioTotalPorProducto;

                        $nombreProducto = $campo[0];
                        $modelo = $campo[1];
                        $cantidad = $campo[2];
                        $precio = $campo[3];
                        $idProducto = $campo[4];
                        $imagen = $campo[5];
                        $stock = $campo[6];

                        echo
                        "<div class='producto'>
                        <div class='info-producto-container'>
                            <div>
                                <img src='" . $imagen . "' width='170em' height='250em'/>
                                <button onclick=\"eliminarProducto(" . $idProducto . "," . $_SESSION['idCliente'] . ")\">Eliminar producto</button>
                                <button class='comprar' onclick=\"insertarPedido(" . $idProducto . "," . $_SESSION['idCliente'] . ",'" . $modelo . "'," . $cantidad . ", '" . $nombreProducto . "',$precio)\">Comprar</button>
                            </div> 
                            <div class='informacionCarrito'>
                                <div>
                                    <p>" . $nombreProducto . "</p>
                                    <p>" . $modelo . "</p>
                                    <p>Precio unitario: " . $precio . "€</p>
                                    <p>Unidades: <span class='unidadesEnCarrito" . $idProducto . "'>" . $cantidad . "</span></p>
                                    <p class='stock$idProducto' hidden>$stock</p>
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
                    </div><br>";
                    }
                    echo '</div>';
?>
<div class='container-comprar-todo-envio'>
                <div class='comprar-todo-container'>
                    <div class='detalles-compra'>
                        <div class="valor-productos">
                            <p>Precio total sin IVA</p>
                            <p>0€</p>
                        </div>
                        <div class="coste-envio">
                            <p>Coste de envío</p>
                            <p>0€</p>
                        </div>
                        <hr class='linea-separadora'>
                        <div class="coste-IVA">
                            <p>Precio total con IVA</p>
                            <p>0€</p>
                        </div>
                        <button onclick='comprarTodo()'>Comprar todo</button>
                    </div>
                </div>

                <div class='tiempo-envio'>
                    <p>Entrega en 4 - 9 días laborables</p>
                </div>
            <div>
<?php
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
                <a class="linkMensaje" href="iniciarSesion.php" target="_self"><div class="boton"><p>Iniciar sesión/Registrarme</p></div></a>
            </div>';
            }
            ?>
            
        </article>
    </section>

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
                    if (cantidad.innerHTML < stock.innerHTML){
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

        function eliminarNumProducto(idProducto, idCliente,  numProductos, cantidad) {
            // Solicitud AJAX
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.href = "carrito.php";
                }
            };
            xhttp.open("POST", "eliminarNumProducto.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&cantidad=" + cantidad + "&numProductos= " + numProductos);
        }

        function anadirUnidades(idProducto, idCliente, numProductos, cantidad, stock) {
            //Numero maximo que puedes añadir
            let productosA_anadir = stock - cantidad;
            //si el nº de productos a añadir es menor o igual
            if (numProductos <=  productosA_anadir){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        window.location.href = "carrito.php";
                    }
                };
                xhttp.open("POST", "anadirUnidades.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&numProductos= " + numProductos);
            } else {
                //Poner un mensaje mas visible y decente
                alert('En stock hay '+stock);
            }
        }
    </script>
</body>

</html>