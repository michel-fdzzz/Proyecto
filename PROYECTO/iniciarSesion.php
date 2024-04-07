<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="registro.css" rel="stylesheet" type="text/css">
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
        <!--<div class='containerMenuSecundario'>
        <img src="imagenes/menuLineas.webp" width="40em" height="30em" alt="Menu" /><p class='menu'>Menú</p>
    </div>-->
        <a href='tienda.php' target="_self"><img src="imagenes/logo.png" width="100em" height="100em" alt="Logo" /></a>

        <!--<div class='containerBuscador'>
        <input type="text" name="buscador" id='buscador' placeholder="Buscar" />
    </div>-->

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

    <script defer>
        let body = document.querySelector('body');
        let lupaContainer = document.querySelector('.lupa');
        let lupaImagen = document.querySelector('.lupaImagen');
        let menuSecundario = document.querySelector('.desplegable');
        let menuTexto = document.querySelector('.menu');

        let busqueda = document.querySelector('.containerBusqueda');
        busqueda = null; // Declarar la variable fuera del alcance de la función


        lupaContainer.addEventListener('click', function() {
            if (busqueda) {
                busqueda.remove();
                menuTexto.textContent = 'Menú';
                busqueda = null; // Establecer la variable como nula después de eliminar el elemento de búsqueda
            } else {
                let contenedor = document.querySelector('.buscadorContainer')
                busqueda = document.createElement('div');
                busqueda.setAttribute('class', 'containerBusqueda');
                let input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('name', 'buscador');
                input.setAttribute('id', 'buscador');
                input.setAttribute('placeholder', 'Buscar');
                busqueda.appendChild(input);
                contenedor.appendChild(busqueda);
                //Insertar el contenedor antes del formulario en el DOM
                body.insertBefore(contenedor, document.querySelector('form'));

            }
        });

        function desplegable() {
            var desplegable = document.querySelector(".containerDesplegable");

            if (desplegable.classList.contains("mostrar")) {
                desplegable.style.display = "none";
                menuTexto.textContent = 'Menú';
                lupaImagen.src = 'imagenes/lupa.png';
                desplegable.classList.remove("mostrar");

            } else {
                desplegable.style.display = "block";
                menuTexto.textContent = 'Cerrar';
                desplegable.classList.add("mostrar");
                // Añadir un event listener para cerrar el dropdown cuando haces clic fuera de él
                document.addEventListener('click', cerrarDesplegable);
            }
        }

        function cerrarDesplegable(event) {
            var desplegable = document.querySelector(".containerDesplegable");
            var button = document.querySelector(".botonDesplegar");
            if (!desplegable.contains(event.target) && event.target !== button) {
                desplegable.style.display = "none";
                document.removeEventListener('click', cerrarDesplegable);
            }
        }
    </script>
</body>

</html>