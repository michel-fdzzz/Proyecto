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
    // Mostrar el contenedor de la ley al hacer clic en el elemento con clase "leyes"
    $(".leyes").click(function () {
        $(".leyes-contenedor").fadeIn();
    });

    // Cerrar el contenedor de la ley al hacer clic en el botón de cierre
    $(".cerrar").click(function () {
        $(".leyes-contenedor").fadeOut();
    });

    // Mostrar el contenedor de información de contacto al hacer clic en el elemento con clase "info-contacto"
    $(".info-contacto").click(function () {
        $(".info-contacto-contenedor").fadeIn();
    });

    // Cerrar el contenedor de información de contacto al hacer clic en el botón de cierre
    $(".cerrar-info-contacto").click(function () {
        $(".info-contacto-contenedor").fadeOut();
    });

    // Mostrar el contenedor "Quiénes somos" al hacer clic en el elemento con clase "quienes-somos"
    $(".quienes-somos").click(function () {
        alert('ds')
        $(".quienes-somos-contenedor").fadeIn();
    });

    // Cerrar el contenedor "Quiénes somos" al hacer clic en el botón de cierre
    $(".cerrar-quienes-somos").click(function () {
        $(".quienes-somos-contenedor").fadeOut();
    });
});
