<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
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
                distinción y estilo.</p>
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
                    "<a href='producto.php?idProducto=" . $campo[0] . "&nombreProducto=" . $campo[1] . "&modelo=" . $campo[2] . "&precio=" . $campo[4] . "&imagen=" . $campo[5] . "&descripcion=" . $campo[7] . "&stock=" . $campo[6] . "'  target='_blank' class='link-producto'>
                    <div class='producto'>
                     <img src='imagenes/" . $campo[5] . "'  class='producto-imagen'/>
                    <h4>" . $campo[1] . "</h4>
                    <p class='grey'>" . $campo[7] . "</p>
                    <p>" . $campo[4] . " €</p>
                    </div>
                    </a>";
                }
            }

            ?>

        </article>

      <!--  <h1>Nuestros productos más exclusivos</h1>
        <article class="productos-exclusivos-container">

            <?php
/*
            $con = new Conexion();
            $con = $con->conectar();
            $select = "select * from producto order by precio desc limit 6";
            $rest = $con->query($select);
            $campos = $rest->fetch_all();
            if ($rest->num_rows > 0) {
                foreach ($campos as $campo) {
                    echo
                    "<a href='producto.php?idProducto=" . $campo[0] . "&nombreProducto=" . $campo[1] . "&modelo=" . $campo[2] . "&precio=" . $campo[4] . "&imagen=" . $campo[5] . "&descripcion=" . $campo[7] . "&stock=" . $campo[6] . "'  target='_blank' class='link-producto'>
                    <div class='producto'>
                     <img src='imagenes/" . $campo[5] . "'  class='producto-imagen'/>
                    <h4>" . $campo[1] . "</h4>
                    <p class='grey'>" . $campo[7] . "</p>
                    <p>" . $campo[4] . " €</p>
                    </div>
                    </a>";
                }
            }*/
            ?>



        </article>
        -->

        <section class="container-newsletter">
        <article class="newsletter">
            <h1>Únete a Michel & CO</h1>
            <p>Recibe las últimas noticias y ofertas</p>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <input name="Email" id="Email" class="input-newsletter" type="email" placeholder='Correo electrónico' />
                
                <input  type="submit" value="Enviar" name="enviar" class='boton-newsletter'/>
            </form>
        </article>
        </section>
    </section>
    <?php
    include 'footer.php';
    ?>

    <script>
        
    </script>
</body>

</html>