<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="CSS/registro.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="CSS/header.css" type="text/css">
</head>

<body>
    <?php include 'conexion.php';
    session_start();
    ?>
    <section class="menuPrincipal">
        <div class="desplegable">
            <button onclick="desplegable()" class="botonDesplegar"><img src="imagenes/menuLineas.png" width="40em" height="30em" alt="Menu" />
                <p class='menu'>Menú</p>
            </button>
            <div class="containerDesplegable">
                <a href="#">Opción 1</a>
                <a href="#">Opción 2</a>
                <a href="#">Opción 3</a>
            </div>
        </div>
        <a href='tienda.php' target="_self"><img src="imagenes/logo.png" width="100em" height="100em" alt="Logo" /></a>

        <div class="containerIconos">
            <div class="iconoInicioSesion">
                <a href="inicioSesion.php" target="_self">
                    <img src="imagenes/perfil-removebg-preview (1).png" width="29em" height="29em" alt="Carrito" />
                </a>
            </div>

            <div class="lupa">
                <img class='lupaImagen' src="imagenes/lupa.png" width="25em" height="25em" alt="Carrito" />
            </div>

            <div class="carrito">
                <a href="carrito.php" target="_self">
                    <img src="imagenes/carrito.png" width="29em" height="29em" alt="Carrito" />
                </a>
            </div>
        </div>
    </section>


    <div class='buscadorContainer'></div>

    <section class="main">
        <form action="#" method="POST" class="formulario">
            <div class="flex-container">
                <h2>Inicio de sesión</h2>

                <label for="email">Correo</label>
                <input type="email" name="correo" required>

                <label for="contrasenia">Contraseña</label>
                <input type="password" name="contrasenia" id='contrasenia' required>

                <input type="submit" value="Enviar" name='enviar'>

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
                $select = "select correoElectronico, contrasenia from usuarioRegistrado 
            where correoElectronico = '" . $_POST['correo'] . "' 
            and contrasenia = '" . $_POST['contrasenia'] . "'";
                $rest = $con->query($select);

                if ($rest->num_rows > 0) {
                    //Select para darle valor a la variable de sesion del id del cliente
                    $select = "select id from usuarioRegistrado 
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
                        header('Location: tienda.php');
                    }

                    // Si no hay una cuenta con la contraseña y correo que el usuario a introducido muestra un mensaje
                } else {
                    echo "<div id = 'errorDiv'> <p id = 'error'>El correo o contraseña introducidos no están registrados</p></div>";
                }
            }
            $con->close();
        }
        ?>
    </section>
    <script defer src="JS/header.js">
    </script>
</body>

</html>