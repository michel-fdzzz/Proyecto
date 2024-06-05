<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="CSS/iniciarSesion.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="JS/header.js"></script>
    <script defer src="JS/inicioSesion.js"></script>
</head>

<body>
    <?php
    include 'header.php';
    //La sesion se inicia en el header y la conexion
    ?>

    <section class="main">
        <form action="#" method="POST" class="formulario">
            <div class="flex-container">
                <h2>Inicio de sesión</h2>

                <label for="email">Correo</label>
                <input type="email" name="correo" required>

                <label for="contrasenia">Contraseña</label>
                <input type="password" name="contrasenia" id='contrasenia' required>

                <input type="submit" value="Enviar" name='enviar' id='enviar'>

                <div id = 'errorDiv'> <p id = 'error'>El correo o contraseña introducidos no están registrados</p></div>

            </div>
            <a href="registro.php" target="_self" class='linkRegistroInicioSesion'>No tengo cuenta, registrarme.</a>
        </form>
        <?php
        // Si inicias sesión comprobamos mediante un select que la cuenta esté registrada en la base de datos
        if (isset($_POST['enviar'])) {
            $con = new Conexion();
            $con = $con->conectar();

            if ($con->connect_error) {
                die('Conexion fallida: ' . $con->connect_error);
            } else {
                $select = "select correoElectronico, contrasenia from usuario 
            where correoElectronico = '" . $_POST['correo'] . "' 
            and contrasenia = '" . $_POST['contrasenia'] . "'";
                $rest = $con->query($select);

                if ($rest->num_rows > 0) {
                    //Select para darle valor a la variable de sesion del id del cliente
                    $select = "select id from usuario 
                where correoElectronico = '" . $_POST['correo'] . "' 
                and contrasenia = '" . $_POST['contrasenia'] . "'";
                    $restId = $con->query($select);

                    // Se le asigna a la variable de sesión la id del cliente que ha iniciado sesión para que se muestre en todo 
                    // momento en el carrito sus productos y para que pueda usar la página en general
                    if ($restId->num_rows > 0) {
                        while ($fila = $restId->fetch_assoc()) {
                            foreach ($fila as $id) {
                                $_SESSION['idCliente'] = $id;
                            }
                        }
                        header('Location: index.php');
                    }

                    // Si no hay una cuenta con la contraseña y correo que el usuario a introducido muestra un mensaje
                } else {   ?>
                   <script>
                        document.getElementById('errorDiv').style.display = 'block';
                        document.getElementById('enviar').style.marginBottom = '0';
                   </script>
    <?php       }
            }
            $con->close();
        }
        ?>
    </section>
    <?php
    include 'footer.php';
    ?>
   
</body>

</html>