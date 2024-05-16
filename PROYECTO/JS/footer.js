document.addEventListener('DOMContentLoaded', function () {
    let leyes = document.querySelector('.leyes');
    leyes.addEventListener('click', function () {
        document.querySelector('.leyes-contenedor').style.display = 'block';
    });

    // Cerrar la ventana emergente al hacer clic en el botón de cierre
    let cerrar_leyes = document.querySelector('.cerrar');
    cerrar_leyes.addEventListener('click', function () {
        document.querySelector('.leyes-contenedor').style.display = 'none';

    });

    let info_contacto = document.querySelector('.info-contacto');
    info_contacto.addEventListener('click', function () {
        document.querySelector('.info-contacto-contenedor').style.display = 'block';
    });

    // Cerrar la ventana emergente al hacer clic en el botón de cierre
    let cerrar_info_contacto = document.querySelector('.cerrar-info-contacto');
    cerrar_info_contacto.addEventListener('click', function () {
        document.querySelector('.info-contacto-contenedor').style.display = 'none';
    });
});