let body = document.querySelector('body');
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
                let contenedor = document.querySelector('.buscadorContainer')
                busqueda = document.createElement('div');
                busqueda.setAttribute('class', 'containerBusqueda');
                let input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('name', 'buscador');
                input.setAttribute('id', 'buscador');
                input.setAttribute('placeholder', 'Buscar');
                busqueda.appendChild(input);
                contenedor.appendChild(busqueda);
                //Insertar el contenedor antes del formulario en el DOM
                body.insertBefore(contenedor, document.querySelector('form'));

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