let body = document.querySelector('body');
let lupaContainer = document.querySelector('.lupa');
let introduccion = document.querySelector('.intro')
let busqueda = document.querySelector('.buscadorContainer');
busqueda = null; //para que no se quede vacía como tal y no de error

lupaContainer.addEventListener('click', function() {
    // Eliminar cualquier contenedor de búsqueda existente
    let buscadoresAnteriores = document.querySelectorAll('.containerBusqueda');
    buscadoresAnteriores.forEach(function(buscador) {
        // Agregar clase para la transición de desaparición
        buscador.classList.add('cerrarBusqueda');
        // Eliminar el elemento después de la transición
        setTimeout(function() {
            buscador.remove();
        }, 200); // Tiempo de espera igual al tiempo de la transición
    });
    
    if (busqueda) {
        busqueda = null; //para que no se quede vacía como tal y no de error
    } else {
        let contenedor = document.querySelector('.buscadorContainer');
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
        // Encontrar el elemento con la clase .main
        let mainElement = document.querySelector('.main');
        // Insertar el contenedor de búsqueda antes del elemento .main
        mainElement.parentNode.insertBefore(contenedor, mainElement);

        function buscar(texto) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Se controla que si introduces mal el nombre, salga un mensaje de que no se ha encontrado el producto que buscas pero salen los productos similares.
                    // try {
                    mostrarProductos(JSON.parse(this.responseText));
                    /* } catch {
                         let body = document.querySelector('body');
                         let div = document.createElement('div');
                         div.setAttribute('class', 'mensajeBusqueda');
                         let p = document.createElement('p');
                         p.innerHTML = 'No se han encontrado resultados de tu busqueda: ' + texto;
                         div.appendChild(p);
                         body.appendChild(div);
                         let seg = 2.5;

                         function temp() {
                             if (seg <= 0) {
                                 clearInterval(tiempo);
                                 div.remove();
                                 p.remove();
                             } else {
                                 seg--;
                             }
                         }
                         temp();
                         let tiempo = setInterval(temp, 1000);
                     }*/
                }
            };
            xhttp.open("POST", "busqueda.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("input=" + texto);
            return false;
        }

        // Según se escribe en el buscador se va recibiendo su valor
        let buscador = document.getElementById('buscador');
        buscador.addEventListener('input', function() {
            let texto = document.querySelector('#buscador').value;
            buscar(texto);
        });
    }
});

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



        function añadirCarrito(idProducto, idCliente, nombreProducto, modelo, cantidad, precio) {
                // Solicitud AJAX
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert('idProducto, idCliente, nombreProducto, modelo, cantidad, precio');
                        document.getElementById('numProductos' + idProducto).value = '';
                    }
                };
                xhttp.open("POST", "añadirCarrito.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idProducto=" + idProducto + "&idCliente=" + idCliente + "&nombreProducto=" + nombreProducto + "&modelo=" + modelo + "&cantidad=" + cantidad + "&precio=" + precio);
        }
        

        // Poner que salte un mensaje de iniciar sesión o registrarte
        function añadirSinUsuario() {
            let contenedor = document.createElement('div');
            let mensajeIniciarSesion = document.createElement('p');
            let link = document.createElement('button');
            alert('Debes iniciar sesion para añadir productos al carrito');
        }

