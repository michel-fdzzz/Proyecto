<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="CSS/patek.css" rel="stylesheet" type="text/css">
    <script defer src='JS/patek.js'></script>
    <script defer src='JS/paginasMarcas.js'></script>
</head>

<body>
    <?php include 'header.php';
    //La sesion se inicia en el header y la conexion
    ?>


    <section class="main">
    <div class="container-imagen">
        <img src='imagenes/patek-logo.svg' class='imagenInicial'/>
    </div>

        <article class="intro" id="intro">
            <h2 class="slogan">"Nunca un Patek Philippe es del todo suyo. Suyo es el placer de custodiarlo hasta la siguiente generación"</h2>
            
        </article>
        <article class="productos-container" id="productos-container">

            <?php

            $con = new Conexion();
            $con = $con->conectar();
            $numElementos = 4;
           
            $totalProductos = $con->query("SELECT COUNT(*) FROM producto WHERE marca = 'Patek Philippe'")->fetch_row()[0];
            $totalPaginas = ceil($totalProductos / $numElementos);

            
            if (isset($_GET['pag'])){
                $pagina = $_GET['pag'];
            } else {
                $pagina = 1;
            }
            $select = "select * from producto where marca = 'Patek Philippe' LIMIT ". (($pagina - 1) * $numElementos). "," . $numElementos;
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
                <a href="patek.php?pag=<?php echo $pagina - 1; ?>#intro">
                    <button>Anterior</button>
                </a>
            <?php else: ?>
                <button disabled>Anterior</button>
            <?php endif; ?>

            <span>Página <?php echo $pagina; ?> de <?php echo $totalPaginas; ?></span>

            <?php if ($pagina < $totalPaginas): ?>
                <a href="patek.php?pag=<?php echo $pagina + 1; ?>#intro">
                    <button>Siguiente</button>
                </a>
            <?php else: ?>
                <button disabled>Siguiente</button>
            <?php endif; ?>
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