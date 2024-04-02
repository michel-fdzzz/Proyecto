<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link href="registro.css" rel="stylesheet" type="text/css">
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
    <div class='containerMenuSecundario'>
        <img src="imagenes/menuLineas.webp" width="40em" height="30em" alt="Menu" /><p class='menu'>Menú</p>
    </div>
    <a href='tienda.php' target="_self"><img src="imagenes/logo.png" width="90em" height="90em" alt="Logo" /></a>
    
    <!--<div class='containerBuscador'>
        <input type="text" name="buscador" id='buscador' placeholder="Buscar" />
    </div>-->

    <div class="containerIconos">
        <div class="lupa">
            <img class='lupaImagen' src="imagenes/lupa.png" width="25em" height="25em" alt="Carrito" />
        </div>

      <div class="iconoInicioSesion">
        <a href="inicioSesion.php" target="_self">
          <img src="imagenes/perfil-removebg-preview (1).png" width="29em" height="29em" alt="Carrito" />
        </a>
      </div>

      <div class="carrito">
        <a href="carrito.php" target="_self">
          <img src="imagenes/carrito.png" width="29em" height="29em" alt="Carrito" />
        </a>
      </div>
    </div>
  </section>


  <script defer>
    let body =  document.querySelector('body');
    let lupaContainer = document.querySelector('.lupa');
    let lupaImagen = document.querySelector('.lupaImagen');
    let menuSecundario = document.querySelector('.containerMenuSecundario');
    let menuTexto = document.querySelector('.menu');

    let busqueda = document.querySelector('.containerBusqueda');
   

    lupaContainer.addEventListener('click', function() {
        
        // Si busqueda existe
        if (busqueda) {
            busqueda.remove();
            menuTexto.textContent = 'Menú';
        } else {
            menuTexto.textContent = 'Cerrar';
            // Si no existe lo mostramos
            busqueda = document.createElement('div');
            busqueda.setAttribute('class', 'containerBusqueda');
            let input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'buscador');
            input.setAttribute('id', 'buscador');
            input.setAttribute('placeholder', 'Buscar');
            busqueda.appendChild(input);
            body.appendChild(busqueda);
        }
    });

    menuSecundario.addEventListener('click', function() {
        // Tiene que ser con un elemnto a través de una clase, no crearr el div en sí
        let div = document.querySelector('.containerDiv');
        lupaImagen.remove();

        if (div) {
            div.remove();
            menuTexto.textContent = 'Menú';
            let img = document.createElement('img');
            // Establecer los atributos src, width, height y alt
            img.src = 'imagenes/lupa.png';
            img.width = '25em';
            img.height = '25em';
            img.alt = 'Busqueda';
            img.classList.add('lupaImagen');
            // Agregar la imagen al cuerpo del documento (o a cualquier otro elemento que desees)
            lupaContainer.appendChild(img);
        } else if (busqueda){
            busqueda.remove();
            menuTexto.textContent = 'Menú';
        } else {
            menuTexto.textContent = 'Cerrar';
            div = document.createElement('div');
            div.setAttribute('class', 'containerDiv');
        
            let seccion1 = document.createElement('p');
            seccion1.textContent = 'fe';

            div.appendChild(seccion1);
            body.appendChild(div);
        }
    });

  </script>
</body>

</html>