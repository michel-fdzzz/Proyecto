<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/agregar-producto-gestion.css">
</head>
<body>
    <?php
    include 'header.php';
    ?>

    <section class="main">
        <h1>Agrega un reloj</h1>
        <article class="contenedor-formulario">
            <form action="#" method="POST" class="formulario" onsubmit="return validarContrasenia()">
                <div class="flex-container">

                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" required>

                    <label for="marca">Marca</label>
                    <input type="text" name="marca" required>

                    <label for="modelo">Modelo</label>
                    <input type="text" name="modelo" required>

                    <label for="precio">Precio</label>
                    <input type="number" name="precio" id='precio' required>

                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen">

                    <input type="submit" value="Agregar a la base de datos" name='enviar'>

                </div>
        </form>
        </article>
    </section>




<?php
    include 'footer.php';
?>
</body>
</html>