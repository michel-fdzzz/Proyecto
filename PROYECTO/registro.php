<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link href="CSS/registro.css" rel="stylesheet" type="text/css">
  <link href="CSS/header.css" rel="stylesheet" type="text/css">
  <script>
    function validarContrasenia() {
      let contraseña = document.getElementById("contrasenia").value;
      let tieneMayuscula = /[A-Z]/.test(contraseña); // Comprueba si hay al menos una o varias mayúsculas
      let tieneSimbolo = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(contraseña); // Comprueba si hay uno o varios simbolos
      let tieneNumero = /[0-9]/.test(contraseña); // Comprueba si uno o varios números

      if (!tieneMayuscula || !tieneSimbolo || !tieneNumero || contraseña.length < 8) {
        alert("La contraseña debe tener al menos 8 caracteres y contener al menos una mayúscula, un símbolo y un número.");
        document.getElementById("contrasenia").value = "";
        return false;
      }
      return true;
    }
  </script>
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

  <section class="main">
    <form action="#" method="POST" class="formulario" onsubmit="return validarContrasenia()">
      <div class="flex-container">
        <h2>Registro</h2>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" required>

        <label for="email">Correo</label>
        <input type="email" name="correo" required>

        <label for="contrasenia">Contraseña</label>
        <input type="password" name="contrasenia" id='contrasenia' required>

        <label for="domicilio">Domicilio</label>
        <input type="text" name="domicilio">

        <input type="submit" value="Enviar" name='enviar'>

      </div>
      <a href="iniciarSesion.php" target="_self" class='linkRegistroInicioSesion'>Ya tengo cuenta, iniciar sesión.</a>
    </form>
    <?php
    /*
    Si pulsas el botón de registrarse hacemos la conexion con la base de datos para insertar
    el nuevo usuario en la tabla de usuarioRegistrado 
    */
    if (isset($_POST['enviar'])) {
      $con = new Conexion();
      $con = $con->conectar();

      if ($con->connect_error) {
        die('Conexion fallida: ' . $con->connect_error);
      } else {

        $select = "select correoElectronico from usuarioRegistrado 
                where correoElectronico = '" . $_POST['correo'] . "'";
        $restCuentaExiste = $con->query($select);

        //Si el correo con el que queremos registrarnos existe, informamos al usuario que ya está registrado
        if ($restCuentaExiste->num_rows > 0) {
          echo "<div id = 'errorDiv'><p id = 'error'>Este correo ya está registrado</p></div>";

          //Si el correo no existe, ejecutamos el insert
        } else {
          $insert = "insert into usuarioRegistrado (nombre, apellidos, domicilio, correoElectronico, contrasenia) 
          values ('" . $_POST['nombre'] . "', '" . $_POST['apellidos'] . "', '" . $_POST['domicilio'] . "', '" . $_POST['correo'] . "', '" . $_POST['contrasenia'] . "')";

          $rest = $con->query($insert);
          // Obtenemos el id del usuario que hemos registrado a través de un select
          if ($rest === true) {
            $select = "select id from usuarioRegistrado 
                where correoElectronico = '" . $_POST['correo'] . "' 
                and contrasenia = '" . $_POST['contrasenia'] . "'";
            $restId = $con->query($select);

            // Si devuelve el resultado del select significa que el correo  y la contraseña y existen y vamos a recoger el id de ese usuario en una variable de sesión
            // para usarla más adelante, como en tienda.php o carrito.php o a la hora de insertar pedidos y mostrar los productos del carrito
            if ($restId->num_rows > 0) {
              while ($fila = $restId->fetch_assoc()) {
                foreach ($fila as $id) {
                  echo $id;
                  $_SESSION['idCliente'] = $id;
                }
              }
              header('Location: tienda.php');
            }
          }
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