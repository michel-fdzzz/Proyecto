<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="CSS/tienda.css" rel="stylesheet" type="text/css">
    <script defer src='JS/tienda.js'></script>
</head>

<body>
    <?php include 'header.php';
    //La sesion se inicia en el header y la conexion
    ?>


    <section class="main">
        <article class="intro">
            <h1>Michel & CO</h1>
            <h2 class="slogan">"El tiempo nunca se detiene, encuentra tu estilo en cada segundo."</h2>
            <p>En un mundo donde la elegancia y la precisión se fusionan en cada detalle, damos vida a una 
                experiencia única. En nuestra empresa, nos dedicamos a capturar la esencia del tiempo, 
                reflejando la sofisticación y la excelencia en cada creación proporcionando a nuestros clientes los mejores relojes. 
                Bienvenidos a un universo donde la artesanía se encuentra con la innovación, donde cada reloj cuenta una historia de 
                distinción y estilo..</p>
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
                <a href='producto.php?idProducto=" . $campo[0] . "&idCliente=" . $_SESSION['idCliente'] . "&nombreProducto=" . $campo[1] . "&modelo=" . $campo[2] . "&precio=" . $campo[4] . "&imagen=" . $campo[5] . "&descripcion=" . $campo[7] . "&stock=" . $campo[6] . "'> <img src='imagenes/" . $campo[5] . "' class='producto-imagen'/></a>
                <p>" . $campo[1] . "</p>
                <p>" . intval($campo[4]) . " €</p>
                Cantidad: Mirar pa quitarlo<input type='number' id='numProductos" . $campo[0] . "' max='$campo[6]' min='0' /><br>
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
    <?php
    include 'footer.php';
    ?>
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
                img.setAttribute('src', '' + producto[5] + '');
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


                let button = document.createElement('button');
                button.textContent = 'Añadir al carrito';

                button.setAttribute('onclick',
                    'añadirCarrito(' + producto[0] + ',' + <?php echo $_SESSION['idCliente']; ?> + ',"' + producto[1] + '","' + producto[2] + '" , document.getElementById(\'numProductos' + producto[0] + '\').value, "' + producto[4] + '" )');

                producto_container.appendChild(img);
                producto_container.appendChild(nombre);
                producto_container.appendChild(marca);
                producto_container.appendChild(precio);
                producto_container.appendChild(labelProductos);
                producto_container.appendChild(inputCantidad);
                producto_container.appendChild(caracteristicas);
                producto_container.appendChild(stock);
                producto_container.appendChild(button);
                containerProductos.appendChild(producto_container);
            }
        }

        //Controlar que no se pueda meter más del stock que hay manualmente
        
    </script>
</body>

</html>