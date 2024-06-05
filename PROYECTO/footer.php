<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/footer.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src='JS/footer.js'></script>
</head>
<body>
    <footer>
        <section class="contenedor-items-footer">
            <article class="contenedor-imagen">
            <a href='index.php' target="_self"><img src="imagenes/logo.png" width="80em" height="80em" alt="Logo" /></a>
            </article>

            <article class="contenedor-info-footer">
                <div class="contenedor-privacidad">
                    <h1>Ayuda</h1>
                    <p class='preguntas-frecuentes'>Preguntas frecuentes</p>
                    <p class='info-contacto'>Informacion de contacto</p>
                </div>

                <div class="contenedor-privacidad">
                    <h1>Información</h1>
                    <p class='leyes'>Ley de proteccion de datos digitales</p>
                </div>

                <div class="contenedor-privacidad">
                    <h1>Sobre Nosotros</h1>
                    <p class='quienes-somos'>Quienes somos</p>
                    <p class='ubicacion'>Ubicación</p>
                </div>
            </article>

            <article class="contenedor-final-footer">
                <p>Michel & CO</p>
            </article>
        </section>


           <!-- Agregamos un contenedor para la ventana emergente -->
    <div class="leyes-contenedor" id='leyes-contenedor-container'>
        <div class="contenedor-cont-apartados-footer">
            <!-- Agregamos el botón de cierre -->
            <span class="cerrar">&times;</span>
            <!-- Aquí se mostrará la información de la ley -->
            <h1>Ley de proteccion de datos digitales</h1>
            <p class='sin-margen'>La Ley de Protección de Datos Digitales de 2024 tiene como objetivo salvaguardar la privacidad y los derechos de los ciudadanos en el ámbito digital. Establece principios fundamentales, como la legalidad y transparencia en el manejo de datos personales, el consentimiento explícito para su recopilación y tratamiento, así como el derecho de los individuos a acceder, corregir y eliminar su información. Además, impone responsabilidades a las entidades que manejan datos y establece sanciones para aquellos que infrinjan la ley. Una autoridad independiente supervisará su cumplimiento y los ciudadanos tendrán derecho a presentar quejas en caso de violación de sus derechos de privacidad.</p>
        </div>
    </div>
    
    <div class="info-contacto-contenedor" id='info-contacto-container'>
        <div class="contenedor-cont-apartados-footer">
            <!-- Agregamos el botón de cierre -->
            <span class="cerrar-info-contacto">&times;</span>
            <!-- Aquí se mostrará la información de la ley -->
            <h1>Informacion de contacto</h1>
            <div class='contacto'>
                <div class="email">Correo: <a href="mailto:Michel&CO@gmail.com">Michel&CO@gmail.com</a></div>
                <div class="telefono">Atención al cliente: <a href="tel:+34678574678">678574678</a></div>
            </div>
        </div>
    </div>
    
    <div class="quienes-somos-contenedor" id='quienes-somos-container'>
        <div class="contenedor-cont-apartados-footer">
            <!-- Agregamos el botón de cierre -->
            <span class="cerrar-quienes-somos">&times;</span>
            <!-- Aquí se mostrará la información de la ley -->
            <h1>Quienes somos</h1>
            <p class='sin-margen'>

            En el corazón de Madrid se alza la boutique más exclusiva de relojes: "Michel & Co". Con sus paredes de cristal reluciente y una decoración que irradia elegancia y lujo, esta tienda es el destino definitivo para los amantes de los relojes de alta gama. <br>

            La historia de "Michel & Co" se remonta a décadas atrás, cuando el joven emprendedor, Michel, fascinado por la artesanía y la precisión de los relojes suizos, decidió convertir su pasión en su profesión. Comenzó su negocio en un modesto local, donde vendía relojes de marcas reconocidas, pero pronto se ganó una reputación por su atención al detalle y su dedicación a proporcionar a sus clientes las piezas más exquisitas.<br>

            Con el tiempo, la tienda se convirtió en un referente en el mundo de la relojería de alta gama. Michel viajaba por todo el mundo en busca de las últimas creaciones de las mejores marcas de relojes, desde los clásicos atemporales hasta las innovadoras obras maestras de la relojería contemporánea. Su habilidad para seleccionar cuidadosamente cada pieza, asegurándose de que reflejara la calidad y el estilo que definían a "Michel & Co", le valió el respeto y la lealtad de una clientela fiel y distinguida.<br>

            Pero "Michel & Co" no era solo una tienda de relojes; era un lugar donde se contaban historias. Cada reloj tenía su propia narrativa: un regalo de aniversario, un símbolo de éxito profesional, una herencia familiar. Michel y su equipo no solo vendían relojes, sino que también ayudaban a sus clientes a encontrar la pieza perfecta que encajara con su estilo de vida y personalidad.<br>

            La boutique se convirtió en un punto de encuentro para coleccionistas, aficionados y curiosos por igual. Eventos exclusivos, lanzamientos de colecciones y charlas sobre la historia de la relojería se celebraban regularmente en el elegante espacio de "Michel & Co", donde la pasión por los relojes se compartía y celebraba entre amigos.<br>

            Con el paso de los años, "Michel & Co" se ha convertido en mucho más que una tienda de relojes; es un destino de referencia para aquellos que buscan algo más que una simple medición del tiempo. Es un lugar donde la artesanía se encuentra con la historia, donde el lujo se combina con la pasión y donde cada reloj cuenta una historia única que perdura en el tiempo.<br>
            </p>
        </div>
    </div>

    <div class="ubicacion-contenedor" id='ubicacion-container'>
        <div class="contenedor-cont-apartados-footer">
            <span class="cerrar-ubicacion">&times;</span>
            <h1>Ubicacion</h1>
            <div class='iframe-container'>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12171.661392135189!2d-3.73335475!3d40.2998385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4220974ada7367%3A0x142fa4db2280e6e7!2sIES%20Matem%C3%A1tico%20Puig%20Adam!5e0!3m2!1ses!2ses!4v1716906338274!5m2!1ses!2ses" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <div class="preguntas-frecuentes-contenedor" id='preguntas-frecuentes-container'>
        <div class="contenedor-cont-apartados-footer">
            <span class="cerrar-preguntas-frecuentes">&times;</span>
            <div class="pregunta-contenedor">
                <h3 class="pregunta-frecuente">¿Cuál es el horario de atención?</h3>
                <div class="respuesta">
                    <p>El horario de atención es de lunes a viernes, de 9:00 a 18:00.</p>
                </div>
            </div>
            
            <div class="pregunta-contenedor">
                <h3 class="pregunta-frecuente">¿Cómo puedo contactar con vosotros si tengo un problema?</h3>
                <div class="respuesta">
                    <p>Puedes contactar con nosotros a través del correo Michel&CO@gmail.com o llamando al 678574678.</p>
                </div>
            </div>

            <div class="pregunta-contenedor">
                <h3 class="pregunta-frecuente">¿Cuál es la política de devoluciones?</h3>
                <div class="respuesta">
                    <p>Las devoluciones estan comprendidas en un plazo de 15 días desde que recibes el reloj.</p>
                </div>
            </div>

            <div class="pregunta-contenedor">
                <h3 class="pregunta-frecuente">¿Los envío son solo nacionales?</h3>
                <div class="respuesta">
                    <p>No, también realizamos envíos internacionales con un coste de envío adicional.</p>
                </div>
            </div>

            <div class="pregunta-contenedor">
                <h3 class="pregunta-frecuente">¿Puedo rastrear mi pedido?</h3>
                <div class="respuesta">
                    <p>No directamente, pero puedes contactar con nosostros a través de nuestro número de teléfono dando el número de pedido.</p>
                </div>
            </div>

            <div class="pregunta-contenedor">
                <h3 class="pregunta-frecuente">¿Qué métodos de pago aceptan?</h3>
                <div class="respuesta">
                    <p>Aceptamos tarjetas de crédito, débito, PayPal y transferencias bancarias. Proximamente se podrá pagar a través de bizum.</p>
                </div>
            </div>

            <div class="pregunta-contenedor">
                <h3 class="pregunta-frecuente">¿Ofrecen descuentos para estudiantes?</h3>
                <div class="respuesta">
                    <p>No, todos los relojes tendrán el mismo coste para todos nuestros clientes.</p>
                </div>
            </div>

            <!--
            <div class="pregunta-contenedor">
                <h3 class="pregunta-frecuente">¿Cómo puedo actualizar mi información de cuenta?</h3>
                <div class="respuesta">
                    <p>Puedes actualizar tu información de cuenta en la sección "Mi cuenta" en nuestro sitio web.</p>
                </div>
            </div>
            -->
        </div>
    </div>
</footer>

</body>
</html>