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
        <a href="#" class='apartados-desplegable'>Rolex</a>
        <a href="#" class='apartados-desplegable'>Patek</a>
        <a href="#" class='apartados-desplegable'>Tissot</a>
        <?php
          if (isset($_SESSION['idCliente'])) {
            $con = new Conexion();
            $con = $con->conectar();
            
            // Preparar la consulta
            $select = "SELECT tipo FROM usuario WHERE id = ?";
            $stmt = $con->prepare($select);
        
            if ($stmt) {
                // Vincular parámetros e ID del cliente
                $stmt->bind_param("i", $_SESSION['idCliente']);
                // Ejecutar la consulta
                $stmt->execute();
                // Obtener resultado
                $stmt->bind_result($tipo);
                // Verificar si se encontró el tipo
                if ($stmt->fetch()) {
                    // Comparar el tipo obtenido
                    if ($tipo == 1) {
                        echo '<a href="gestion.php" class="apartados-desplegable">Gestión de productos</a>';
                    }
                }
                // Cerrar la consulta preparada
                $stmt->close();
            } else {
                // Manejar error si la preparación de la consulta falla
                die('Error en la preparación de la consulta: ' . $con->error);
            }
            // Cerrar conexión
            $con->close();
        }
        
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

  <script defer src="JS/header.js">
  </script>
</body>

</html>