let body = document.querySelector('body');
        let lupaContainer = document.querySelector('.lupa');
        let lupaImagen = document.querySelector('.lupaImagen');
        let menuSecundario = document.querySelector('.desplegable');
        let menuTexto = document.querySelector('.menu');

        let tituloCarrito = document.querySelector('tituloCarrito');

        let busqueda = document.querySelector('.containerBusqueda');
        busqueda = null; //para que no se quede vacía como tal y no de error

        lupaContainer.addEventListener('click', function() {
            if (busqueda) {
                busqueda.remove();
                menuTexto.textContent = 'Menú';
                busqueda = null;  //para que no se quede vacía como tal y no de error
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
                body.insertBefore(tituloCarrito, document.querySelector('.tituloCarrito'));

            }
        });
        function desplegable() {
            var desplegable = document.querySelector(".containerDesplegable");

            //Si se está mostrando
            if (desplegable.classList.contains("mostrar")) {
                desplegable.style.display = "none";
                menuTexto.textContent = 'Menú';
                lupaImagen.src = 'imagenes/lupa.png';
                desplegable.classList.remove("mostrar");

                //Si no se muestra
            } else {
                desplegable.style.display = "block";
                menuTexto.textContent = 'Cerrar';
                desplegable.classList.add("mostrar");
                document.addEventListener('click', cerrarDesplegable);
            }
        }

        function cerrarDesplegable(event) {
            var desplegable = document.querySelector(".containerDesplegable");
            var button = document.querySelector(".botonDesplegar");

            //Si el click no se da en el área donde está el evento ni ha dado concretamente al botón. Se cierra el desplegable
            if (!desplegable.contains(event.target) && event.target !== button) {
                desplegable.style.display = "none";
                menuTexto.textContent = 'Menú';
                desplegable.classList.remove("mostrar");
                //document.removeEventListener('click', cerrarDesplegable);
            }
        }


        try {
            document.querySelector('.desconexion').addEventListener('click', function() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log('Conexion hecha')
                        window.location.href = "tienda.php";
                    }
                };
                xhttp.open("POST", "desconectarse.php", true);
                xhttp.send();
            });
        } catch {
            console.log('La clase no existe porque no hay ningún id asociado a la variable de seison')
        }