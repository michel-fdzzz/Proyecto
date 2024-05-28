
$(document).ready(function () {

    //Ley de proteccion de datos

    $(".leyes").click(function () {
        $(".leyes-contenedor").fadeIn();
    });

    $(".cerrar").click(function () {
        $(".leyes-contenedor").fadeOut();
    });

    //Informacion de contacto (Atención al cliente)

    $(".info-contacto").click(function () {
        $(".info-contacto-contenedor").fadeIn();
    });

    $(".cerrar-info-contacto").click(function () {
        $(".info-contacto-contenedor").fadeOut();
    });

    //Quienes somos

    $(".quienes-somos").click(function () {
        $(".quienes-somos-contenedor").fadeIn();
    });

    $(".cerrar-quienes-somos").click(function () {
        $(".quienes-somos-contenedor").fadeOut();
    });

    //Ubicación

    $(".ubicacion").click(function () {
        $(".ubicacion-contenedor").fadeIn();
    });

    $(".cerrar-ubicacion").click(function () {
        $(".ubicacion-contenedor").fadeOut();
    });

    //Preguntas frecuentes

    $(".preguntas-frecuentes").click(function () {
        $(".preguntas-frecuentes-contenedor").fadeIn();
    });

    $(".cerrar-preguntas-frecuentes").click(function () {
        $(".preguntas-frecuentes-contenedor").fadeOut();
    });

    $('.pregunta-frecuente').on('click', function () {
        //Cierra las preguntas abiertas
        $('.respuesta').not($(this).next('.respuesta')).slideUp();
        //Muestra la pregunta en la que has hecho click
        $(this).next('.respuesta').slideToggle();
    });

    $('.cerrar-preguntas-frecuentes').on('click', function () {
        $('.preguntas-frecuentes-contenedor').slideUp();
    });
});
