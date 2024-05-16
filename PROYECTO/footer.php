<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/footer.css">
    <script defer src='JS/footer.js'></script>
</head>
<body>
    <footer>
        <section class="contenedor-items-footer">
            <article class="contenedor-imagen">
            <a href='tienda.php' target="_self"><img src="imagenes/logo.png" width="80em" height="80em" alt="Logo" /></a>
            </article>

            <article class="contenedor-info-footer">
                <div class="contenedor-privacidad">
                    <h1>Privacidad</h1>
                    <p class='leyes'>Ley de proteccion de datos digitales</p>
                    <p>Licencias</p>
                </div>

                <div class="contenedor-privacidad">
                    <h1>Privacidad</h1>
                    <p class='info-contacto'>Informacion de contacto</p>
                    <p>Licencias</p>
                </div>

                <div class="contenedor-privacidad">
                    <h1>Privacidad</h1>
                    <p>Leyes</p>
                    <p>Licencias</p>
                </div>
            </article>

            <article class="contenedor-final-footer">
                <p>Michel & CO</p>
            </article>
        </section>


           <!-- Agregamos un contenedor para la ventana emergente -->
    <div class="leyes-contenedor" style="display: none;">
        <div class="contenedor-cont-apratados-footer">
            <!-- Agregamos el botón de cierre -->
            <span class="cerrar">&times;</span>
            <!-- Aquí se mostrará la información de la ley -->
            <h1>Ley de proteccion de datos digitales</h1>
            <p class='sin-margen'>La Ley de Protección de Datos Digitales de 2024 tiene como objetivo salvaguardar la privacidad y los derechos de los ciudadanos en el ámbito digital. Establece principios fundamentales, como la legalidad y transparencia en el manejo de datos personales, el consentimiento explícito para su recopilación y tratamiento, así como el derecho de los individuos a acceder, corregir y eliminar su información. Además, impone responsabilidades a las entidades que manejan datos y establece sanciones para aquellos que infrinjan la ley. Una autoridad independiente supervisará su cumplimiento y los ciudadanos tendrán derecho a presentar quejas en caso de violación de sus derechos de privacidad.</p>
        </div>
    </div>

    <div class="info-contacto-contenedor" style="display: none;">
        <div class="contenedor-cont-apratados-footer">
            <!-- Agregamos el botón de cierre -->
            <span class="cerrar-info-contacto">&times;</span>
            <!-- Aquí se mostrará la información de la ley -->
            <h1>Informacion de contacto</h1>
            <div class='contacto'>
                <div class="email">Correo: <a href="mailto:Michel&CO@gmail.com">Michel&CO@gmail.com</a></div>
                <div class="telefono">Atención al cliente: <a href="tel:+34678574678">678574678</a></div>
            <div>
        </div>
    </div>
    </footer>

</body>
</html>