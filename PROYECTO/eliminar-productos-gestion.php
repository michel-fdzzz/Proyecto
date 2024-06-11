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
    $tabindex = 13;
    ?>

    <section class="main">
        <article class="container-productos">

            <?php
            $con = new Conexion();
            $con = $con->conectar();

            $select = "SELECT id, imagen, nombre, marca
            FROM producto
            ORDER BY marca DESC";
            $stmt = $con->prepare($select);

            if ($stmt) {
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($fila = $result->fetch_assoc()) {

                        $id = $fila['id'];
                        $imagen = $fila['imagen'];
                        $nombre = $fila['nombre'];
                        $marca = $fila['marca'];

                        echo "
                <div class='producto'>
                <div class='info'>
                    <img src='imagenes/$imagen'/>
                    <h4>$marca $nombre</h4>
                </div>
                <div class='boton'>
                    <button onclick='eliminarProducto($id)' tabindex='$tabindex' aria-label='Eliminar $marca $nombre'>Eliminar</button>
                </div>
            </div>";
                        $tabindex++;
                    }
                } else {
                    echo "No se encontraron resultados.";
                }
            } else {
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