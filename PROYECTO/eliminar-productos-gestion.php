<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/eliminar-producto-gestion.css">
    <script defer src='JS/eliminar-gestion.js'></script>
</head>
<body>
    <?php
    include 'header.php';
    ?>

    <section class="main">
    <article class="container-productos">
            


    <?php
    $con = new Conexion();
    $con = $con->conectar();
    // Preparar la consulta SQL
    $select = "SELECT id, imagen, nombre 
            FROM producto
            ORDER BY nombre DESC";
    $stmt = $con->prepare($select);

    // Verificar si la consulta se preparó correctamente
    if ($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
                // Acceder a los valores de cada columna
                $id = $fila['id'];
                $imagen = $fila['imagen'];
                $nombre = $fila['nombre'];

                // Haz lo que necesites hacer con los datos de cada fila
                // Por ejemplo, puedes imprimirlos en pantalla
                echo "
                <div class='producto'>
                <div class='info'>
                    <img src='imagenes/$imagen'/>
                    <p>$nombre</p>
                </div>
                <div class='boton'>
                    <button onclick='eliminarProducto($id)'>Eliminar</button>
                </div>
            </div>";
            }
        } else {
            echo "No se encontraron resultados.";
        }
    } else {
        // Si la consulta no se preparó correctamente, muestra un mensaje de error
        die('Error al preparar la consulta: ' . $con->error);
    }

    $stmt->close();
    $con->close();
    ?>

    
    </article>
</section>
  
<?php
    include 'footer.php';
?>

</body>
</html>