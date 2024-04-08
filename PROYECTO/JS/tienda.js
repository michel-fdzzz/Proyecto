let body = document.querySelector('body');
        let lupaContainer = document.querySelector('.lupa');
        let lupaImagen = document.querySelector('.lupaImagen');
        let menuSecundario = document.querySelector('.desplegable');
        let menuTexto = document.querySelector('.menu');
        let introduccion = document.querySelector('.intro')

        let busqueda = document.querySelector('.buscadorContainer');
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
                body.insertBefore(introduccion, document.querySelector('article'));

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



        function añadirCarrito(idProducto, idCliente, nombreProducto, talla, cantidad, precio) {
            // Controlamos mediante varios if que el usuario sepa que debe llenar los campos con los valores correspondientes
            if (cantidad === "" || isNaN(cantidad) || cantidad <= 0) {
                alert('Tienes que especificar las unidades del producto que vas a comprar y su talla');
            } else if (cantidad > 3) {
                alert('Solo puedes comprar entre 1 y 3 unidades de cada producto mientras tengan la misma talla.');
            } else if (talla > 50 || talla < 15) {
                alert('Las tallas están comprendidas entre el numero 15 y el 50, ambos inclusive.');
            } else {
                // Solicitud AJAX
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert('Se ha añadido al carrito correctamente');
                        document.getElementById('numProductos' + idProducto).value = '';
                        document.getElementById('talla' + idProducto).value = '';
                    }
                };
                xhttp.open("POST", "añadirCarrito.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&nombreProducto=" + nombreProducto + "&talla=" + talla + "&cantidad=" + cantidad + "&precio=" + precio);
            }
        }

        // POner que salte un mensaje de iniciar sesión o registrarte
        function añadirSinUsuario() {
            let contenedor = document.createElement('div');
            let mensajeIniciarSesion = document.createElement('p');
            let link = document.createElement('button');
        }