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
    <div class="desplegable">
      <button onclick="desplegable()" class="botonDesplegar"><img src="imagenes/menuLineas.png" width="40em" height="30em" alt="Menu" /><p class='menu'>Menú</p></button>
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


  <form action="https://formsubmit.co/ino@rentdays.com" method="POST" class="contac">
        <div class="flex-container">
            <label for="Nombre">
                Nombre
            </label>
            <input type="text" class="nombre_campo" name="Nombre">
            <label for="email">
                Correo
            </label>
            <input type="email" class="nombre_campo" name="Email">
            <label for="email">
                Piso 
            </label>
            <select name="" id="">
                <option value="Planetario">Planetario</option>
                <option value="Casa_adosada">Casa adosada</option>
                <option value="Apartamento_de_lujo">Apartamento de lujo</option>
            </select>
            


            <label for="Entrada" class="entrada_label">Dia de entrada</label>
            <input type="date" class="entrada_campo" id="entrada_fecha" name="Fecha_entrada_reserva" value="2023-04-24" min="2023-04-24" max="2023-12-31">

            <label for="salida" class="salida_label">Dia de salida</label>
            <input type="date" class="salida_campo" id="salida_fecha" name="Fecha_salida_reserva" value="2023-04-25" min="2023-04-24" max="2023-12-31">


            <label for="adulto" class="adulto_label">Cantidad de Adultos </label>
            <input type="number" class="adulto_campo" id="adulto_cantidad" name="Cantidad_Adultos" value="1" min="1" step="1">

            <label for="niños" class="niños_label">Cantidad de niños:</label>
            <input type="number" class="niños_campo" id="niños_cantidad" name="Cantidad_Niños" value="0" min="0" step="1">

            <input type="submit" class="enviar_btn" value="Enviar">

        </div>
    </form>






  <script defer>
    let body =  document.querySelector('body');
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