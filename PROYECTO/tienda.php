<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="CSS/tienda.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'conexion.php';
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
                <p class="desconexion">Desconectarse</p>';
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

    <article class="intro">
        <h1>Michel & CO</h1>
        <h2 class="slogan">"El tiempo nunca se detiene, encuentra tu estilo en cada segundo."</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos non perspiciatis, vero obcaecati amet itaque voluptatum consectetur iste enim voluptatem maiores. Numquam ratione, ducimus magnam sapiente accusantium veritatis cum. Corrupti.</p>
    </article>
    <article class="productos-container">

        <?php

        $con = new Conexion();
        $con = $con->conectar();
        $select = "select * from producto";
        $rest = $con->query($select);
        $campos = $rest->fetch_all();
        if ($rest->num_rows > 0) {
            foreach ($campos as $campo) {
                echo
                "<div class='producto'>
                <img src='" . $campo[5] . "' width='200em' height='300em'/>
        <p class='bold'>" . $campo[1] . "</p>
        <p class='bold'>" . intval($campo[4]) . " €</p>
        Cantidad: <input type='number' id='numProductos" . $campo[0] . "' max='3' min='1' /><br>";

                if (isset($_SESSION['idCliente'])) {
                    echo "<button onclick=\"añadirCarrito(" . $campo[0] . "," . $_SESSION['idCliente'] . ",'" . $campo[1] . "','" . $campo[2] . "', document.getElementById('numProductos" . $campo[0] . "').value,'" . $campo[4] . "')\">Añadir al carrito</button>";
                } else {
                    echo "<button onclick\"añadirSinUsuario()>Añadir al carrito</button>";
                }
                echo "</div>";
            }
        }

        ?>

    </article>







    <script defer src='JS/tienda.js'>

    </script>

    <script defer>
        // Muestra los productos según los resultados de la busqueda que optenemos mediante un select en busqueda.php
        function mostrarProductos(productos) {
            let containerProductos = document.querySelector('.containerProductos');
            containerProductos.innerHTML = '';

            // Se muestran todos los productos de forma dinámica
            for (let producto of productos) {

                let productoDiv = document.createElement('div');
                productoDiv.classList.add('producto');

                let nombre = document.createElement('p');
                nombre.textContent = producto[1];
                nombre.classList.add('bold');

                let precio = document.createElement('p');
                precio.textContent = producto[2] + '€';
                precio.classList.add('bold');

                let labelProductos = document.createElement('label');
                labelProductos.textContent = 'Cantidad: ';

                let labelTalla = document.createElement('label');
                labelTalla.textContent = 'Talla (EU): ';

                let br1 = document.createElement('br');

                let inputTalla = document.createElement('input');
                inputTalla.setAttribute('type', 'number');
                inputTalla.setAttribute('id', 'talla' + producto[0]);
                inputTalla.setAttribute('max', '50');
                inputTalla.setAttribute('min', '15');

                let br2 = document.createElement('br');

                let inputNumeros = document.createElement('input');
                inputNumeros.setAttribute('type', 'number');
                inputNumeros.setAttribute('id', 'numProductos' + producto[0]);
                inputNumeros.setAttribute('max', '3');
                inputNumeros.setAttribute('min', '1');

                let botonAniadirCarrito = document.createElement('button');
                botonAniadirCarrito.textContent = 'Añadir al carrito';

                botonAniadirCarrito.setAttribute('onclick',
                    'añadirCarrito(' + producto[0] + ',' + <?php echo $_SESSION['idCliente']; ?> + ',"' + producto[1] + '",document.getElementById(\'talla' + producto[0] + '\').value , document.getElementById(\'numProductos' + producto[0] + '\').value, "' + producto[2] + '" )');

                productoDiv.appendChild(nombre);
                productoDiv.appendChild(precio);
                productoDiv.appendChild(labelTalla);
                productoDiv.appendChild(inputTalla);
                productoDiv.appendChild(br1);
                productoDiv.appendChild(labelProductos);
                productoDiv.appendChild(inputNumeros);
                productoDiv.appendChild(br2);
                productoDiv.appendChild(botonAniadirCarrito);
                containerProductos.appendChild(productoDiv);
            }
        }
    </script>
</body>

</html>