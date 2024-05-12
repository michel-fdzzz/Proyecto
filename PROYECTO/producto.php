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
    $idCliente = $_GET["idCliente"];
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
                    <p class='grey'>" . $descripcion . "</p>
                    <p><b>" . intval($precio) . " €</b></p>
                    Cantidad: Mirar pa quitarlo<input type='number' id='numProductos" . $idProducto . "' max='$stock' min='0' /><br>
                    <p class='grey'>" . $modelo . "</p>
                   ";



                    if (isset($_SESSION['idCliente'])) {
                        echo "<button onclick=\"añadirCarrito(" . $idProducto . "," . $idCliente . ",'" . $nombreProducto . "','" . $modelo . "', document.getElementById('numProductos" . $idProducto . "').value,'" . $precio . "')\">Añadir al carrito</button>";
                    } else {
                        echo "<button onclick=\"añadirSinUsuario()\">Añadir al carrito</button>";
                    }
                    echo "</div></div>";
               

                   
                
            

            ?>

        </article>
    </section>
    <?php
    include 'footer.php';
    ?>
</body>

</html>