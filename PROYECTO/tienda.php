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
    <div class="container-imagen">
        <img src='imagenes/fotoFondo2.jpg' class='imagenInicial'/>
    </div>

        <article class="intro" id="intro">
            <h1 class='h1-grande'>Michel & CO</h1>
            <h2 class="slogan">"El tiempo nunca se detiene, encuentra tu estilo en cada segundo."</h2>
            <p>En un mundo donde la elegancia y la precisión se fusionan en cada detalle, damos vida a una 
                experiencia única. En nuestra empresa, nos dedicamos a capturar la esencia del tiempo, 
                reflejando la sofisticación y la excelencia en cada creación proporcionando a nuestros clientes los mejores relojes. 
                Bienvenidos a un universo donde la artesanía se encuentra con la innovación, donde cada reloj cuenta una historia de 
                distinción y estilo.</p>
        </article>
        <article class="productos-container" id="productos-container">

            <?php

            $con = new Conexion();
            $con = $con->conectar();
            $numElementos = 4;
           
            $totalProductos = $con->query("SELECT COUNT(*) FROM producto")->fetch_row()[0];
            $totalPaginas = ceil($totalProductos / $numElementos);

            
            if (isset($_GET['pag'])){
                $pagina = $_GET['pag'];
            } else {
                $pagina = 1;
            }
            $select = "select * from producto  LIMIT ". (($pagina - 1) * $numElementos). "," . $numElementos;
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
    <div class="container-botones-paginacion">
            <?php if ($pagina > 1): ?>
                <a href="tienda.php?pag=<?php echo $pagina - 1; ?>#intro">
                    <button>Anterior</button>
                </a>
            <?php else: ?>
                <button disabled>Anterior</button>
            <?php endif; ?>

            <span>Página <?php echo $pagina; ?> de <?php echo $totalPaginas; ?></span>

            <?php if ($pagina < $totalPaginas): ?>
                <a href="tienda.php?pag=<?php echo $pagina + 1; ?>#intro">
                    <button>Siguiente</button>
                </a>
            <?php else: ?>
                <button disabled>Siguiente</button>
            <?php endif; ?>
        </div>

        

      <h1 class='h1-productos-exclusivos'>Nuestros productos más exclusivos</h1>

      <div class="productos-exclusivos">
        <article class="productos-exclusivos-container">
            <!--<section class="contenedor-botones-scroll">
                <div class="boton-izquierda">izq</div>
                <div class="boton-derecha">der</div>
            </section>-->
            <?php

            $con = new Conexion();
            $con = $con->conectar();
            $select = "select * from producto order by precio desc limit 10";
            $rest = $con->query($select);
            $campos = $rest->fetch_all();
            if ($rest->num_rows > 0) {
                foreach ($campos as $campo) {
                    echo
                    "<a href='producto.php?idProducto=" . $campo[0] . "&nombreProducto=" . $campo[1] . "&modelo=" . $campo[2] . "&precio=" . $campo[4] . "&imagen=" . $campo[5] . "&descripcion=" . $campo[7] . "&stock=" . $campo[6] . "'  target='_blank' class='link-producto'>
                    <div class='producto-exclusivo'>
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
        </div>

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


        if (isset($_POST['enviar'])) {
            $correo = 'michel.fdzzz04@gmail.com';
            $titulo = 'Suscripción al newsletter';
            $mensaje = '';
            if (mail($correo, $titulo, $mensaje)) {
                echo "<p>Mensaje enviado correctamente.</p>";
            } else {
                echo "<p>Error al enviar el mensaje.</p>";
            }
    
        }

    ?>
    
</body>

</html>