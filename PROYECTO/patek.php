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
            <img src='imagenes/patek-logo.svg' class='imagenInicial' />
        </div>

        <article class="intro" id="intro">
            <h2 class="slogan">"Nunca un Patek Philippe es del todo suyo. Suyo es el placer de custodiarlo hasta la
                siguiente generación"</h2>

        </article>
        <article class="productos-container" id="productos-container">

            <?php

            $con = new Conexion();
            $con = $con->conectar();
            $numElementos = 4;

            $totalProductos = $con->query("SELECT COUNT(*) FROM producto WHERE marca = 'Patek Philippe'")->fetch_row()[0];
            $totalPaginas = ceil($totalProductos / $numElementos);

            //Empieza siendo 14 ya que las cosas del header llegan a ser hasta 13
            $tabindex = 14;

            if (isset($_GET['pag'])) {
                $pagina = $_GET['pag'];
            } else {
                $pagina = 1;
            }
            $select = "select * from producto where marca = 'Patek Philippe' LIMIT " . (($pagina - 1) * $numElementos) . "," . $numElementos;
            $rest = $con->query($select);
            $campos = $rest->fetch_all();
            if ($rest->num_rows > 0) {
                foreach ($campos as $campo) {
                    echo
                        "<a href='producto.php?idProducto=" . $campo[0] . "&nombreProducto=" . $campo[1] . "&modelo=" . $campo[2] . "&precio=" . $campo[4] . "&imagen=" . $campo[5] . "&descripcion=" . $campo[7] . "&stock=" . $campo[6] . "'   tabindex='$tabindex' target='_blank' class='link-producto' aria-label='Acceder a $campo[1]'>
                    <div class='producto'>
                     <img src='imagenes/" . $campo[5] . "' alt='$campo[2] $campo[1]' class='producto-imagen'/>
                    <h4>" . $campo[1] . "</h4>
                    <p class='grey'>" . $campo[7] . "</p>
                    <p>" . $campo[4] . " €</p>
                    </div>
                    </a>";
                    $tabindex++;
                }
            }
            ?>
        </article>
        <div class="container-botones-paginacion">
            <?php if ($pagina > 1): ?>
                <a href="patek.php?pag=<?php echo $pagina - 1; ?>#intro" tabindex="<?php echo $tabindex;
                     $tabindex++; ?>">
                    <button>Anterior</button>
                </a>
            <?php else: ?>
                <button disabled>Anterior</button>
            <?php endif; ?>

            <span>Página <?php echo $pagina; ?> de <?php echo $totalPaginas; ?></span>

            <?php if ($pagina < $totalPaginas): ?>
                <a href="patek.php?pag=<?php echo $pagina + 1; ?>#intro" tabindex="<?php echo $tabindex;
                     $tabindex++; ?>">
                    <button>Siguiente</button>
                </a>
            <?php else: ?>
                <button disabled>Siguiente</button>
            <?php endif; ?>
        </div>


        <section class="container-newsletter">
            <article class="newsletter">
                <h1 tabindex="<?php echo $tabindex;
                $tabindex++; ?>">Únete a Michel & CO</h1>
                <p tabindex="<?php echo $tabindex;
                $tabindex++; ?>">Recibe las últimas noticias y ofertas</p>
                <div class="form">
                    <input name="Email" id="Email" class="input-newsletter" type="email"
                        placeholder='Correo electrónico' aria-label="Introduce tu email para suscribirte al newsletter"
                        tabindex="<?php echo $tabindex;
                        $tabindex++; ?>" />
                    <input type="submit" value="Enviar" name="enviar" class='boton-newsletter' tabindex="<?php echo $tabindex;
                    $tabindex++; ?>" />
                </div>
            </article>
        </section>
    </section>

    <div class="container-mensajeAnadidoNewsletter">
        <div class="mensajeAnadidoNewsletter">
            <p>Suscripción al newsletter exitosa</p><img src='imagenes/check.svg' alt='check' />
        </div>
    </div>


    <div class="container-mensajeNoAnadidoNewsletter">
        <div class="mensajeNoAnadidoNewsletter">
            <p>Has introducido un correo vacío o ya registrado en newsletter.</p>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>

</body>

</html>