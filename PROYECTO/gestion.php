<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
    <link rel="stylesheet" href="CSS/gestion.css">
</head>

<body>
    <?php
    include 'header.php';
    $tabindex = 13;
    ?>

    <section class="main">
        <h1>Gestión</h1>
        <article class="contenedor-opciones">
            <ul class="lista-opciones">
                <li class="opcion"><a href='agregar-productos-gestion.php' aria-label="Sección para agregar productos"
                        tabindex="<?php echo $tabindex;
                        $tabindex++; ?>">
                        <p>Agregar productos</p>
                    </a></li>
                <li class="opcion"><a href='eliminar-productos-gestion.php' aria-label="Sección para eliminar productos"
                        tabindex="<?php echo $tabindex;
                        $tabindex++; ?>">
                        <p>Eliminar productos</p>
                    </a></li>
                <li class="opcion"><a href='eliminar-usuarios-gestion.php' aria-label="Sección para gestionar usuarios"
                        tabindex="<?php echo $tabindex;
                        $tabindex++; ?>">
                        <p>Gestión de usuarios</p>
                    </a></li>
            </ul>
        </article>
    </section>




    <?php
    include 'footer.php';
    ?>
</body>

</html>