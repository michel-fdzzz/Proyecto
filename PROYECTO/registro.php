<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link href="CSS/registro.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    function validarContrasenia() {
      let contraseña = document.getElementById("contrasenia").value;
      let tieneMayuscula = /[A-Z]/.test(contraseña); // Comprueba si hay al menos una o varias mayúsculas
      let tieneSimbolo = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(contraseña); // Comprueba si hay uno o varios simbolos
      let tieneNumero = /[0-9]/.test(contraseña); // Comprueba si uno o varios números

      if (!tieneMayuscula || !tieneSimbolo || !tieneNumero || contraseña.length < 8) {
        let flex_container = document.querySelector('.flex-container');
        let mensaje = document.createElement('p');
        mensaje.textContent = 'La contraseña debe tener al menos 8 caracteres y contener al menos una mayúscula, un símbolo y un número.';
        mensaje.style.color = 'red';
        document.getElementById("contrasenia").value = "";
        flex_container.appendChild(mensaje);
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
  <?php include 'header.php';
  //La sesion se inicia en el header y la conexion
  $tabindex = 13;
  ?>


  <section class="main">
    <form action="#" method="POST" class="formulario" onsubmit="return validarContrasenia()">
      <div class="flex-container">
        <h2 tabindex="<?php echo $tabindex;
        $tabindex++; ?>">Registro</h2>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" aria-label="Escribe tu nombre" tabindex="<?php echo $tabindex;
        $tabindex++; ?>" required>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" aria-label="Escribe tu apellido" tabindex="<?php echo $tabindex;
        $tabindex++; ?>" required>

        <label for="email">Correo</label>
        <input type="email" name="correo" aria-label="Escribe tu correo" tabindex="<?php echo $tabindex;
        $tabindex++; ?>" required>

        <label for="contrasenia">Contraseña</label>
        <input type="password" name="contrasenia" id='contrasenia'
          aria-label="Escribe tu contraseña, debe tener como mínimo 8 caracteres, 1 número, una letra mayuscula y un símbolo"
          tabindex="<?php echo $tabindex;
          $tabindex++; ?>" required>

        <label for="domicilio">Domicilio</label>
        <input type="text" name="domicilio" aria-label="Escribe tu domicilio para las entregas de los productos"
          tabindex="<?php echo $tabindex;
          $tabindex++; ?>" required>

        <input type="submit" value="Registrarme" name='enviar' tabindex="<?php echo $tabindex;
        $tabindex++; ?>">

      </div>
      <div id='errorDiv'>
        <p id='error' tabindex="<?php echo $tabindex;
        $tabindex++; ?>">Este correo ya está registrado</p>
      </div>
      <a href="iniciarSesion.php" target="_self" class='linkRegistroInicioSesion' tabindex="<?php echo $tabindex;
      $tabindex++; ?>">Ya tengo cuenta, iniciar sesión.</a>
    </form>
    <?php
    /*
    Si pulsas el botón de registrarse hacemos la conexion con la base de datos para insertar
    el nuevo usuario en la tabla de usuario 
    */
    if (isset($_POST['enviar'])) {
      $con = new Conexion();
      $con = $con->conectar();

      if ($con->connect_error) {
        die('Conexion fallida: ' . $con->connect_error);
      } else {

        $select = "select correoElectronico from usuario 
                where correoElectronico = '" . $_POST['correo'] . "'";
        $restCuentaExiste = $con->query($select);

        //Si el correo con el que queremos registrarnos existe, informamos al usuario que ya está registrado
        if ($restCuentaExiste->num_rows > 0) {
          echo "
          <script>
            document.getElementById('errorDiv').style.display = 'block';
            document.getElementById('errorDiv').style.color = 'red';
          </script>";

          //Si el correo no existe, ejecutamos el insert
        } else {
          $insert = "insert into usuario (nombre, apellidos, domicilio, correoElectronico, contrasenia, tipo) 
          values ('" . $_POST['nombre'] . "', '" . $_POST['apellidos'] . "', '" . $_POST['domicilio'] . "', '" . $_POST['correo'] . "', '" . $_POST['contrasenia'] . "', 0)";
          $rest = $con->query($insert);
          // Obtenemos el id del usuario que hemos registrado a través de un select
          if ($rest === true) {
            $select = "select id from usuario 
                where correoElectronico = '" . $_POST['correo'] . "' 
                and contrasenia = '" . $_POST['contrasenia'] . "'";
            $restId = $con->query($select);

            // Si devuelve el resultado del select significa que el correo  y la contraseña existen y vamos a recoger el id de ese usuario en una variable de sesión
            // para usarla más adelante, como en index.php o carrito.php o a la hora de insertar pedidos y mostrar los productos del carrito
            if ($restId->num_rows > 0) {
              while ($fila = $restId->fetch_assoc()) {
                foreach ($fila as $id) {
                  $_SESSION['idCliente'] = $id;
                }
              }
              echo "<script>window.location='index.php';</script>";
            }
          }
        }
      }
      $con->close();
    }
    ?>
  </section>
  <?php
  include 'footer.php';
  ?>
  <script defer src="JS/header.js">
  </script>
</body>

</html>