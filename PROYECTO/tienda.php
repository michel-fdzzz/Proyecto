<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="tienda.css" rel="stylesheet" type="text/css">
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
            <?php
            if ($_SESSION['idCliente'] > 0) {
                //Ponerle en el hover el subrayado que tenog en el 3 en raya
                echo '
                <p class="desconexion">Desconectarse de la sesion.</p>';
            } else {
                echo
                '<div class="iconoInicioSesion">
                    <a href="iniciarSesion.php" target="_self">
                        <img src="imagenes/perfil-removebg-preview (1).png" width="29em" height="29em" alt="Carrito" />
                    </a>
                </div>';
            }
            ?>

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



    <?php
    if (isset($_SESSION['idCliente'])) {
        $con = new Conexion();
        $con = $con->conectar();
        $select = "select * from producto";
        $rest = $con->query($select);
        $campos = $rest->fetch_all();
        if ($rest->num_rows > 0) {
            foreach ($campos as $campo) {
                echo
                "<div class='producto'>
                <img src='" . $campo[4] . "'/>
        <p class='bold'>" . $campo[1] . "</p>
        <p class='bold'>" . $campo[2] . "€</p>
        Talla (EU): <input type='number' id='talla" . $campo[0] . "' max='50' min='15' /><br>
        Cantidad: <input type='number' id='numProductos" . $campo[0] . "' max='3' min='1' /><br>
        <button onclick=\"añadirCarrito(" . $campo[0] . "," . $_SESSION['idCliente'] . ",'" . $campo[1] . "',document.getElementById('talla" . $campo[0] . "').value , document.getElementById('numProductos" . $campo[0] . "').value,'" . $campo[2] . "')\">Añadir al carrito</button>
    </div>";
            }
        } else {
            echo '
    <div class="mensaje">
        <p>Actualmente no hay productos insertados en la base de datos</p>
    </div>';
        }
    } else {
        echo '
    <div class="mensaje">
        <p>No has iniciado sesión, registrate o inicia sesión para poder comprar productos</p>
        <a class="linkMensaje" href="inicioSesion.php" target="_self">
            <div class="boton">
                <p>Iniciar sesión/Registrarme</p>
            </div>
        </a>
    </div>';
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


        try {
            document.querySelector('.desconexion').addEventListener('click', function() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log('Conexion hecha')
                        window.location.href = "tienda.php";
                    }
                };
                xhttp.open("POST", "desconectarse.php", true);
                xhttp.send();
            });
        } catch {
            console.log('La clase no existe porque no hay ningún id asociado a la variable de seison')
        }
    </script>
</body>

</html>