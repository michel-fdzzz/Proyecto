<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/agregar-producto-gestion.css">
</head>

<body>
    <?php
    include 'header.php';
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="CSS/agregar-producto-gestion.css">
    </head>

    <body>
        <section class="main">
            <h1 tabindex="1">Agrega un reloj</h1>
            <article class="contenedor-formulario">
                <div class="formulario">
                    <div class="flex-container">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" tabindex="2" aria-label="Nombre" required>

                        <label for="marca">Marca</label>
                        <input type="text" id="marca" tabindex="3" aria-label="Marca" required>

                        <label for="modelo">Modelo</label>
                        <input type="text" id="modelo" tabindex="4" aria-label="Modelo" required>

                        <label for="precio">Precio</label>
                        <input type="number" id="precio" tabindex="5" id='precio' aria-label="Precio" required>

                        <label for="stock">Stock</label>
                        <input type="number" id="stock" tabindex="6" id='stock' aria-label="Stock del producto"
                            required>

                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" rows="1" cols="40" tabindex="7" aria-label="Descripción"
                            required></textarea>

                        <label for="imagen">Imagen</label>
                        <input type="file" id="imagen" tabindex="8" aria-label="Selecciona la foto del reloj">

                        <input type="submit" value="Agregar" tabindex="9" aria-label="Boton agregar" id="btn-agregar">

                    </div>
                </div>
            </article>
        </section>

        <div class="container-mensajeAnadidoBaseDatos">
            <div class="mensajeAnadidoBaseDatos">
                <p>El reloj se ha añadido correctamente a la base de datos</p><img src='imagenes/check.svg'
                    alt='check' />
            </div>
        </div>

        <div class="container-mensajeNoAnadidoBaseDatos">
            <div class="mensajeNoAnadidoBaseDatos">
                <p>Ya tienes este producto en la base de datos</p>
            </div>
        </div>


        <script>
            let btn = document.getElementById('btn-agregar');

            btn.addEventListener('click', function () {
                // Solicitud AJAX
                var xhttp = new XMLHttpRequest();
                let nombre = document.getElementById('nombre');
                let marca = document.getElementById('marca');
                let modelo = document.getElementById('modelo');
                let precio = document.getElementById('precio');
                let stock = document.getElementById('stock');
                let descripcion = document.getElementById('descripcion');
                let imagen = document.getElementById('imagen');

                var arrayDatos = new FormData();
                arrayDatos.append('nombre', nombre.value);
                arrayDatos.append('marca', marca.value);
                arrayDatos.append('modelo', modelo.value);
                arrayDatos.append('precio', precio.value);
                arrayDatos.append('stock', stock.value);
                arrayDatos.append('descripcion', descripcion.value);
                arrayDatos.append('imagen', imagen.files[0]);

                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        let response = JSON.parse(this.responseText);
                        if (response) {
                            mensajeAnadirBaseDatos();
                            // Limpiar los valores de los inputs
                            nombre.value = '';
                            marca.value = '';
                            modelo.value = '';
                            precio.value = '';
                            stock.value = '';
                            descripcion.value = '';
                            imagen.value = '';
                        } else {
                            mensajeNoAnadirBaseDatos();
                            nombre.value = '';
                            marca.value = '';
                            modelo.value = '';
                            precio.value = '';
                            stock.value = '';
                            descripcion.value = '';
                            imagen.value = '';
                        }
                    }
                };
                xhttp.open("POST", "PHP/agregarReloj.php", true);
                xhttp.send(arrayDatos);
            });

            // Función para mostrar la ventana modal
            function mensajeAnadirBaseDatos() {
                $('.container-mensajeAnadidoBaseDatos').css('right', '-100%'); // Coloca el mansaje  fuera de la pantalla
                $('.container-mensajeAnadidoBaseDatos').show().animate({
                    right: '0' // Mueve el mansaje  hacia la izquierda
                }, 500); // Duración de la animación en milisegundos

                // Oculta el mansaje  después de 3 segundos
                setTimeout(function () {
                    $('.container-mensajeAnadidoBaseDatos').animate({
                        right: '-100%' // Mueve el mansaje  hacia la derecha para ocultarla
                    }, 500, function () {
                        $(this).hide(); // Oculta el mansaje  después de la animación
                    });
                }, 4000); // Tiempo de espera en milisegundos antes de ocultar el mansaje 
            }


            function mensajeNoAnadirBaseDatos() {
                $('.container-mensajeNoAnadidoBaseDatos').css('right', '-100%'); // Coloca el mansaje  fuera de la pantalla
                $('.container-mensajeNoAnadidoBaseDatos').show().animate({
                    right: '0' // Mueve el mansaje  hacia la izquierda
                }, 500); // Duración de la animación en milisegundos

                // Oculta el mansaje  después de 3 segundos
                setTimeout(function () {
                    $('.container-mensajeNoAnadidoBaseDatos').animate({
                        right: '-100%' // Mueve el mansaje  hacia la derecha para ocultarla
                    }, 500, function () {
                        $(this).hide(); // Oculta el mansaje  después de la animación
                    });
                }, 4000); // Tiempo de espera en milisegundos antes de ocultar el mansaje 
            }

        </script>

        <?php
        include 'footer.php';
        ?>
    </body>

    </html>