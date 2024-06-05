function buscar(texto, pagina = 1) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let response = JSON.parse(this.responseText);
            console.log(response);
            /**
             * Dividimos la respuesta en 3 partes de las cuales ya está compuesta. 
             * productos: array con la informacion del producto
             * paginaActual: valor de la página en la que estmaos, siempre será la primera, es decir, el 1
             * totalPaginas: el numero de páginas totales
             */
            mostrarProductos(response.productos, response.paginaActual, response.totalPaginas);

            if (response.productos.length == 0) {
                let main = document.querySelector('.main');
                let div = document.createElement('div');
                div.setAttribute('class', 'mensajeBusqueda');

                let spanCerrar = document.createElement("span");
                spanCerrar.textContent = "\u00D7";
                spanCerrar.classList.add("cerrar");

                let p = document.createElement('p');
                p.innerHTML = 'No se han encontrado resultados';
                let gift = document.createElement('img');
                gift.setAttribute('class', 'gift');
                gift.setAttribute('src', 'imagenes/gif_resultados.gif');

                div.appendChild(spanCerrar);
                div.appendChild(p);
                div.appendChild(gift);
                main.appendChild(div);
            }
        }
    };
    xhttp.open("POST", "PHP/busquedaPatek.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("input=" + texto + "&pag=" + pagina);
    return false;
}


//Funcion para abrir y cerrar el buscador
$(document).ready(function () {
    $('.lupa').click(function () {

        $(this).closest('.menuPrincipal').find('.buscadorContainer').toggleClass('activo');

        // Según se escribe en el buscador se va recibiendo su valor
        let buscador = document.getElementById('buscador');
        buscador.addEventListener('input', function () {
            let texto = document.querySelector('#buscador').value;
            buscar(texto);
        });

    });
});
