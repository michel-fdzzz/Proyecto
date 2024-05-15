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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/agregar-producto-gestion.css">
</head>
<body>
    <section class="main">
        <h1>Agrega un reloj</h1>
        <article class="contenedor-formulario">
            <form action="#" method="POST" class="formulario" enctype="multipart/form-data">
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
    // Si la foto se ha recogido bien guardamos en una variable su nombre
    // para usarlo más adelante en la inserción.
    if (isset($_FILES['imagen'])) {
        $nombre_imagen = $_FILES['imagen']['name'];
        $ruta = 'imagenes/' . $nombre_imagen;

        // Si mueve la imagen a la carpeta donde guardo las imagen se procede a insertar en la bbdd, ya que si la foto no está 
        // en las carpeta imagenes, no se mostrará por mucho que esté en la bbdd
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {

            $con = new Conexion();
            $con = $con->conectar();

            if ($con->connect_error) {
                die('Conexion fallida: ' . $con->connect_error);
            } else {

                //Comprobamos si existe el producto
                $select = "select nombre from producto where nombre = ?";
                $stmt1 = $con->prepare($select);

                if ($stmt1){
                    $stmt1->bind_param('s', $_POST['nombre']);
                    $stmt1->execute();
                    $rest = $stmt1->get_result();

                    if ($rest->num_rows > 0){
                        echo '<p>El producto ya existe</p>';

                        //Si no existe se inserta
                    } else {
                        $insert = "INSERT INTO producto (nombre, marca, modelo, precio, imagen, stock, descripcion) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                        $stmt2 = $con->prepare($insert);
        
                        if ($stmt2){
                            $stmt2->bind_param('sssisis', $_POST['nombre'], $_POST['marca'], $_POST['modelo'], $_POST['precio'],$nombre_imagen, $_POST['stock'], $_POST['descripcion']);
                            $stmt2->execute();
                            echo '<p>El producto ha sido insertado con éxito</p>';
                        } else {
                            die('Error al preparar la consulta: '. $con->connect_error);
                        }
                        $stmt2->close();
                    }

                } else {
                    die('Error al preparar la consulta: '. $con->connect_error);
                }
                $stmt1->close();
            }
            $con->close();
        }
    }
}

include 'footer.php';
?>
</body>
</html>
