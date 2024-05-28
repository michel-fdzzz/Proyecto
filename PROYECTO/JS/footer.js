/*document.addEventListener('DOMContentLoaded', function () {
    let leyes = document.querySelector('.leyes');
    leyes.addEventListener('click', function () {
        document.querySelector('.leyes-contenedor').style.display = 'block';
        document.querySelector('.leyes-contenedor').classList.add('mostrar');
    });

    // Cerrar la ventana emergente al hacer clic en el botón de cierre
    let cerrar_leyes = document.querySelector('.cerrar');
    cerrar_leyes.addEventListener('click', function () {
        document.querySelector('.leyes-contenedor').style.display = 'none';
        document.querySelector('.leyes-contenedor').classList.remove('mostrar');
    });

    let info_contacto = document.querySelector('.info-contacto');
    info_contacto.addEventListener('click', function () {
        document.querySelector('.info-contacto-contenedor').style.display = 'block';
        document.querySelector('.info-contacto-contenedor').classList.add('mostrar');
    });

    // Cerrar la ventana emergente al hacer clic en el botón de cierre
    let cerrar_info_contacto = document.querySelector('.cerrar-info-contacto');
    cerrar_info_contacto.addEventListener('click', function () {
        document.querySelector('.info-contacto-contenedor').style.display = 'none';
        document.querySelector('.info-contacto-contenedor').classList.remove('mostrar');
    });
});*/
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
        $(this).next('.respuesta').slideToggle();
    });

    $('.cerrar-preguntas-frecuentes').on('click', function () {
        $('.preguntas-frecuentes-contenedor').slideUp();
    });
});
