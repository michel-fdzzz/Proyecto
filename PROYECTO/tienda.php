<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="CSS/tienda.css" rel="stylesheet" type="text/css">
    <link href="CSS/header.css" rel="stylesheet" type="text/css">
    <script src="JS/menuDesplegable.js" defer></script>

    <script defer src='JS/tienda.js'></script>
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
                <a href='producto.php'> <img src='" . $campo[5] . "' width='200em' height='300em'/></a>
                <p>" . $campo[1] . "</p>
                <p>" . intval($campo[4]) . " €</p>
                Cantidad: Mirar pa quitarlo<input type='number' id='numProductos" . $campo[0] . "' max='3' min='1' /><br>
                <p class='grey'>" . $campo[7] . "</p>
                <p class='grey'>Quedan " . $campo[6] . "</p>";

                    if (isset($_SESSION['idCliente'])) {
                        echo "<button onclick=\"añadirCarrito(" . $campo[0] . "," . $_SESSION['idCliente'] . ",'" . $campo[1] . "','" . $campo[2] . "', document.getElementById('numProductos" . $campo[0] . "').value,'" . $campo[4] . "')\">Añadir al carrito</button>";
                    } else {
                        echo "<button onclick=\"añadirSinUsuario()\">Añadir al carrito</button>";
                    }
                    echo "</div>";
                }
            }

            ?>

        </article>
    </section>
    <script>
        // Muestra los productos según los resultados de la busqueda que optenemos mediante un select en busqueda.php
        function mostrarProductos(productos) {
            console.log(productos);
            let containerProductos = document.querySelector('.productos-container');
            containerProductos.innerHTML = '';

            // Se muestran todos los productos de forma dinámica
            for (let producto of productos) {

                let producto_container = document.createElement('div');
                producto_container.classList.add('producto');

                let img = document.createElement('img');
                img.setAttribute('src', '' + producto[4] + '');
                img.setAttribute('width', '200em');
                img.setAttribute('height', '300em');

                let nombre = document.createElement('p');
                nombre.textContent = producto[1];

                let marca = document.createElement('p');
                marca.textContent = producto[2];

                let precio = document.createElement('p');
                marca.textContent = producto[4];

                let labelProductos = document.createElement('label');
                labelProductos.textContent = 'Cantidad: ';

                let inputCantidad = document.createElement('input');
                inputCantidad.setAttribute('type', 'number');
                inputCantidad.setAttribute('id', 'numProductos' + producto[0]);

                let caracteristicas = document.createElement('p');
                caracteristicas.textContent = '' + producto[7] + '';
                caracteristicas.setAttribute('class', 'grey');

                let stock = document.createElement('p');
                stock.textContent = 'Quedan' + producto[6] + '';
                stock.setAttribute('class', 'grey');
                producto_container.appendChild(img);
                producto_container.appendChild(nombre);
                producto_container.appendChild(marca);
                producto_container.appendChild(precio);
                producto_container.appendChild(labelProductos);
                producto_container.appendChild(inputCantidad);
                producto_container.appendChild(caracteristicas);
                producto_container.appendChild(stock);
                containerProductos.appendChild(producto_container);
            }
        }
    </script>
</body>

</html>