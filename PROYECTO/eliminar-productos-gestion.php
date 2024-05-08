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