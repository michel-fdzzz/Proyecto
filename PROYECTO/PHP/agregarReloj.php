<?php
include ("conexion.php");
//Sin esto no funciona la recogida porque recibimos los datos JSON y esto es lo que se lo hace saber PHP
header('Content-Type: application/json');

$response = false;

$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$descripcion = $_POST['descripcion'];

//Todo lo que se hace con $_Files es para que inserte en la carpeta donde cuerdo las imagenes, la imagen.
if (isset($_FILES['imagen'])) {
    $nombre_imagen = $_FILES['imagen']['name'];
    $ruta = '../imagenes/' . $nombre_imagen;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
        $con = new Conexion();
        $con = $con->conectar();

        if ($con->connect_error) {
            die('Conexión fallida: ' . $con->connect_error);
        } else {
            $select = "SELECT nombre FROM producto WHERE nombre = ?";
            $stmt1 = $con->prepare($select);

            if ($stmt1) {
                $stmt1->bind_param('s', $nombre);
                $stmt1->execute();
                $rest = $stmt1->get_result();

                if ($rest->num_rows <= 0) {
                    $insert = "INSERT INTO producto (nombre, marca, modelo, precio, imagen, stock, descripcion)
                                   VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt2 = $con->prepare($insert);

                    if ($stmt2) {
                        $stmt2->bind_param(
                            'sssisis',
                            $nombre,
                            $marca,
                            $modelo,
                            $precio,
                            $nombre_imagen,
                            $stock,
                            $descripcion
                        );
                        if ($stmt2->execute()) {
                            $response = true;
                        }
                        $stmt2->close();
                    } else {
                        die('Error al preparar la consulta: ' . $con->error);
                    }
                }
                $stmt1->close();
            } else {
                die('Error al preparar la consulta: ' . $con->error);
            }
            $con->close();
        }
    }
}

echo json_encode($response);
?>