<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <link href="CSS/producto.css" rel="stylesheet" type="text/css">
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
    ?>


    <section class="main">
        
        <article class="producto-container">

            <?php

           
                    echo
                "<div class='imagen-producto-container'>
                    <img src='imagenes/" . $imagen . "' class='producto-imagen'/>
                </div>

                <div  class='info-container'>

                <div>
                    <h3>" . $nombreProducto . "</h3>
                    <p class='grey'>" . $modelo . "</p>
                    <p class='grey'>" . $descripcion . "</p>
                    <p><b>" . intval($precio) . " €</b></p>
                    
                    <div class='mas-menos-container'>
                            <div class='mas' id='mas'><p>+</p></div>
                            <p class='unidades' id='numProductos" . $idProducto . "'>0</p>
                            <div class='menos' id='menos'><p>-</p></div>
                        </div>
                    <p class='grey'>Quedan <span class='stock'>" . $stock . "<span></p>
                   ";



                    if (isset($_SESSION['idCliente'])) {
                        echo "<button onclick=\"añadirCarrito(" . $idProducto . "," . $_SESSION['idCliente'] . ",'" . $nombreProducto . "','" . $modelo . "', document.getElementById('numProductos" . $idProducto . "').textContent,'" . $precio . "')\">Añadir al carrito</button>";
                    } else {
                        echo "<button onclick=\"añadirSinUsuario()\">Añadir al carrito</button>";
                    }
                    echo "<hr class='linea-separadora'>
                    <p class='texto-debajo-linea-separadora'>Más $modelo</p>
                    
                    
                    
                    <div class='mas-relojes'>";

                    $con = new Conexion();
                    $con = $con->conectar();
                    $select = "select * from producto where marca = '$modelo' AND id <> $idProducto";
                    $rest = $con->query($select);
                    $campos = $rest->fetch_all();
                    if ($rest->num_rows > 0) {
                        foreach ($campos as $campo) {
                            echo
                            "<div class='contenedor-imagen-mas-relojes'>
                        <a href='producto.php?idProducto=" . $campo[0] . "&nombreProducto=" . $campo[1] . "&modelo=" . $campo[2] . "&precio=" . $campo[4] . "&imagen=" . $campo[5] . "&descripcion=" . $campo[7] . "&stock=" . $campo[6] . "'> <img src='imagenes/" . $campo[5] . "' class='producto-imagen-mas-relojes'/></a>
                        </div>";

                        }
                    } else {
                        echo '<p>No hay más productos de esta marca</p>';
                    }
                    
                    echo "</div>
                    </div></div>";
               

                   
                
            

            ?>

        </article>
    </section>
    <?php
    include 'footer.php';
    ?>

    <script>
            //Seleccionamos todos los elementos con la clase .mas y .menos
            let botonMas = document.querySelector('.mas');
            let botonMenos = document.querySelector('.menos');

            //Creo un evento en el boton más para incrementar, como máximo, el número de unidades a comprar
            botonMas.addEventListener('click', function() {
                let cantidad = document.querySelector('.unidades');
                let stock = document.querySelector('.stock');
                let cantidadActual = parseInt(cantidad.innerHTML);
                let stockDisponible = parseInt(stock.innerHTML);
                if (cantidadActual < stockDisponible) {
                    cantidad.innerHTML = cantidadActual + 1;
                }
            });

            botonMenos.addEventListener('click', function() {
                let cantidad = document.querySelector('.unidades');
                let cantidadActual = parseInt(cantidad.innerHTML);
                if (cantidadActual > 0) {
                    cantidad.innerHTML = cantidadActual - 1;
                }
            });

    </script>
</body>

</html>