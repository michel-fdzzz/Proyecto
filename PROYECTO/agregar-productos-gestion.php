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

                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id='stock' required>

                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" rows="1" cols="40" required></textarea>

                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen">

                    <input type="submit" value="Agregar a la base de datos" name='agregar'>

                </div>
            </form>
        </article>
    </section>
    <?php
    if (isset($_POST['agregar'])) {
      $con = new Conexion();
      $con = $con->conectar();

      if ($con->connect_error) {
        die('Conexion fallida: ' . $con->connect_error);
      } else {

        $insert = "INSERT INTO producto (nombre, marca, modelo, precio, imagen, stock, descripcion) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($insert);

        if ($stmt){
            $stmt->bind_param('sssisis', $_POST['nombre'], $_POST['marca'], $_POST['modelo'], $_POST['precio'], $_POST['imagen'], $_POST['stock'], $_POST['descripcion']);
            $stmt->execute();
        } else {
            die('Error al preparar la consulta: '. $con->connect_error);
        }
        $stmt->close();
      }
      $con->close();
      header('Location: gestion.php');
    }
    ?>
    




<?php
    include 'footer.php';
?>
</body>
</html>