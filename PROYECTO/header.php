<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link href="CSS/header.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <?php 
  session_start();
  include 'conexion.php';
  ?>
  <section class="menuPrincipal">
    <div class="desplegable">
      <button  class="botonDesplegar"><img src="imagenes/menuLineas.png" width="40em" height="30em" alt="Menu" />
        <p class='menu'>Menú</p>
      </button>
      <div class="containerDesplegable">
        <a href="#">Opción 1</a>
        <a href="#">Opción 2</a>
        <a href="#">Opción 3</a>
        <?php

        ?>
      </div>
    </div>

    <a href='tienda.php' target="_self"><img src="imagenes/logo.png" width="80em" height="80em" alt="Logo" /></a>


    <div class="containerIconos">
            <?php
            if (isset($_SESSION['idCliente'])) {
                //Ponerle en el hover el subrayado que tenog en el 3 en raya
                echo '
                <img class="desconexion" src="imagenes/salida-de-incendios.png" width="25em" height="25em" alt="Carrito" />';
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
        <div class='buscadorContainer'>
                  <input type="text" name="buscador" id="buscador" placeholder="Buscar">
        </div>
  </section>


  </section>
  <script defer src="JS/header.js">
  </script>
</body>

</html>