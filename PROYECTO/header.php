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
  include 'PHP/conexion.php';
  ?>
  <section class="menuPrincipal">
    <div class="desplegable">
      <button class="botonDesplegar" tabindex="1"><img src="imagenes/menuLineas.png" width="40em" height="30em"
          alt="Menu" />
        <p class='menu'>Menú</p>
      </button>
      <div class="containerDesplegable">
        <a href="rolex.php" class='apartados-desplegable' tabindex="2">Rolex</a>
        <a href="patek.php" class='apartados-desplegable' tabindex="3">Patek Philippe</a>
        <a href="tissot.php" class='apartados-desplegable' tabindex="4">Tissot</a>
        <?php
        if (isset($_SESSION['idCliente'])) {
          $con = new Conexion();
          $con = $con->conectar();

          $select = "SELECT tipo FROM usuario WHERE id = ?";
          $stmt = $con->prepare($select);

          if ($stmt) {
            $stmt->bind_param("i", $_SESSION['idCliente']);
            $stmt->execute();
            $stmt->bind_result($tipo);
            if ($stmt->fetch()) {

              if ($tipo == 1 || $tipo == 0) {
                echo '<a href="pedidos.php" class="apartados-desplegable" tabindex="5">Pedidos</a>';
              }

              if ($tipo == 1) {
                echo '<a href="gestion.php" class="apartados-desplegable" tabindex="6">Gestión</a>';
              }
            }
            $stmt->close();
          } else {
            die('Error en la preparación de la consulta: ' . $con->error);
          }
          $con->close();
        }

        ?>
      </div>
    </div>
    <div class="contenedor-logo">
      <a href='index.php' target="_self"><img src="imagenes/logo.png" width="80em" height="80em" alt="Logo" tabindex="7"
          aria-label="Recargar la página" /></a>
    </div>

    <div class="containerIconos">
      <?php
      if (isset($_SESSION['idCliente'])) {
        echo '
                <img class="desconexion" src="imagenes/salida-de-incendios.png" width="25em" height="25em" alt="Carrito" tabindex="8"/>';
      } else {
        echo
          '<div class="iconoInicioSesion">
                    <a href="iniciarSesion.php" target="_self" tabindex="9">
                        <img src="imagenes/perfil-removebg-preview (1).png" width="29em" height="29em" alt="Carrito" />
                    </a>
                </div>';
      }
      ?>

      <div class="lupa" tabindex="10">
        <img class='lupaImagen' src="imagenes/lupa.png" width="25em" height="25em" alt="Carrito" />

      </div>


      <div class="carrito" tabindex="11">
        <a href="carrito.php" target="_self">
          <img src="imagenes/carrito.png" width="29em" height="29em" alt="Carrito" />
        </a>
      </div>
    </div>
    <div class='buscadorContainer' tabindex="12">
      <input type="text" name="buscador" id="buscador" placeholder="Buscar">
    </div>
  </section>

  <script defer src="JS/header.js">
  </script>
</body>

</html>