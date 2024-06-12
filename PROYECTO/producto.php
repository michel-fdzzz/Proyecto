<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <link href="CSS/producto.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src='JS/producto.js'></script>
</head>

<body>
    <?php include 'header.php';
    //La sesion se inicia en el header y la conexion
    $idProducto = $_GET["idProducto"];
    $nombreProducto = $_GET["nombreProducto"];
    $modelo = $_GET['modelo'];
    $precio = $_GET["precio"];
    $imagen = $_GET['imagen'];
    $descripcion = $_GET['descripcion'];
    $stock = $_GET['stock'];

    //Empieza siendo 13 ya que las cosas del header llegan a ser hasta 12
    $tabindex = 13;
    ?>


    <section class="main">
        <div class="container-mensajeAnadidoCarrito">
            <div class="mensajeAnadidoCarrito">
                <p>El producto se ha añadido al carrito correctamente</p><img src='imagenes/check.svg' alt='check' />
            </div>
        </div>

        <div class="container-mensajeNoAnadidoCarrito">
            <div class="mensajeNoAnadidoCarrito">
                <p>Ya tienes este producto en el carrito</p>
            </div>
        </div>


        <article class="producto-container">

            <?php


            echo
                "<div class='imagen-producto-container'>
                    <img src='imagenes/" . $imagen . "' alt='$modelo $nombreProducto' class='producto-imagen'/>
                </div>

                <div  class='info-container'>

                <div>
                    <h3 tabindex='$tabindex'>";
            $tabindex++;
            echo $nombreProducto . "</h3>

                    <p class='grey' tabindex='$tabindex'>";
            $tabindex++;
            echo $modelo . "</p>

                    <p class='grey' tabindex='$tabindex'>";
            $tabindex++;
            echo $descripcion . "</p>

                    <p tabindex='$tabindex'>";
            $tabindex++;
            echo "<b>" . intval($precio) . " €</b></p>
                    
                    <div class='mas-menos-container'>
                            <div class='mas' id='mas' tabindex='$tabindex' aria-label='Añadir unidad'>";
            $tabindex++;
            echo "<p>+</p></div>
                            <p class='unidades' id='numProductos" . $idProducto . "' tabindex='$tabindex'>0</p>";
            $tabindex++;

            echo "<div class='menos' id='menos' tabindex='$tabindex' aria-label='Quitar unidad'>";
            $tabindex++;
            echo "<p>-</p></div>
                        </div>
                    <p class='grey' tabindex='$tabindex'>Quedan <span class='stock'>" . $stock . "<span></p>
                   ";
            $tabindex++;


            if (isset($_SESSION['idCliente'])) {
                if ($stock > 0) {
                    echo "<button onclick=\"añadirCarrito(" . $idProducto . "," . $_SESSION['idCliente'] . ",'" . $nombreProducto . "','" . $modelo . "', document.getElementById('numProductos" . $idProducto . "').textContent,'" . $precio . "')\" tabindex='$tabindex'>Añadir al carrito</button>";
                } else {
                    echo "<button tabindex='$tabindex'>Agotado</button>";
                }
            } else {
                echo "<button onclick=\"añadirSinUsuario()\" tabindex='$tabindex'>Añadir al carrito</button>";
            }
            $tabindex++;

            echo "<hr class='linea-separadora'>
                    <p class='texto-debajo-linea-separadora' tabindex='$tabindex'>Más $modelo</p>";
            ?>


            <div class='mas-relojes-container'>
                <div class="scroll-horizontal">
                    <div class='mas-relojes'>
                        <?php
                        $con = new Conexion();
                        $con = $con->conectar();
                        $select = "select * from producto where marca = '$modelo' AND id <> $idProducto";
                        $rest = $con->query($select);
                        $campos = $rest->fetch_all();
                        if ($rest->num_rows > 0) {
                            foreach ($campos as $campo) {
                                echo "
                                    <div class='contenedor-imagen-mas-relojes'>
                                        <a href='producto.php?idProducto=" . $campo[0] . "&nombreProducto=" . $campo[1] . "&modelo=" . $campo[2] . "&precio=" . $campo[4] . "&imagen=" . $campo[5] . "&descripcion=" . $campo[7] . "&stock=" . $campo[6] . "' tabindex='$tabindex' aria-label='$campo[2] $campo[1]'>
                                            <img src='imagenes/" . $campo[5] . "' alt='$campo[2] $campo[1]' class='producto-imagen-mas-relojes'/>
                                        </a>
                                    </div>";
                            }
                        } else {
                            echo '<p>No hay más productos de esta marca</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>


        </article>
    </section>

    <div id="container-mensajeIniciarSesion">
        <div id="mensajeIniciarSesion">
            <span class="close">&times;</span>
            <p>Debes iniciar sesión para añadir productos al carrito</p>
            <button id="login-button">Iniciar Sesión</button>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>

    <script>
        //Seleccionamos todos los elementos con la clase .mas y .menos
        let botonMas = document.querySelector('.mas');
        let botonMenos = document.querySelector('.menos');

        //Creo un evento en el boton más para incrementar, como máximo, el número de unidades a comprar
        botonMas.addEventListener('click', function () {
            let cantidad = document.querySelector('.unidades');
            let stock = document.querySelector('.stock');
            let cantidadActual = parseInt(cantidad.innerHTML);
            let stockDisponible = parseInt(stock.innerHTML);
            if (cantidadActual < stockDisponible) {
                cantidad.innerHTML = cantidadActual + 1;
            }
        });

        botonMenos.addEventListener('click', function () {
            let cantidad = document.querySelector('.unidades');
            let cantidadActual = parseInt(cantidad.innerHTML);
            if (cantidadActual > 0) {
                cantidad.innerHTML = cantidadActual - 1;
            }
        });

    </script>
</body>

</html>