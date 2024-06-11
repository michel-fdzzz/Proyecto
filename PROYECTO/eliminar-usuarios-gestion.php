<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/eliminar-usuarios-gestion.css">
    <script defer src='JS/eliminar-gestion.js'></script>
</head>

<body>
    <?php
    include 'header.php';
    $contUsuarios = 0;
    $tabindex = 13;
    ?>

    <section class="main">

        <?php
        $con = new Conexion();
        $con = $con->conectar();
        $select = "SELECT correoElectronico, tipo, id 
            FROM usuario
            ORDER BY correoElectronico ASC";
        $stmt = $con->prepare($select);

        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo '<table>
            
                <tr>
                    <th>Correo</th>
                    <th>Tipo de usuario</th>
                    <th>
                        Eliminar usuario
                    </th>
                    <th>
                        Cambiar
                    </th>
                </tr>';
                while ($fila = $result->fetch_assoc()) {
                    $correo = $fila['correoElectronico'];
                    $tipo = $fila['tipo'];
                    $id = $fila['id'];

                    echo "
                        <tr>
                            <td>$correo</td>
                            <td>" . tipo_usuario($tipo) . "</td>
                            <td>
                                <button onclick='eliminarUsuario($id)' tabindex='$tabindex' aria-label='Eliminar a $correo' >Eliminar</button>
                            </td>";

                    $tabindex++;

                    echo "
                            <td>
                                <button onclick='cambiar_tipo_usuario($id, $tipo)' tabindex='$tabindex' aria-label='Cambiar a $correo a " . tipo_usuario_aCambiar($tipo) . "' >Cambiar a " . tipo_usuario_aCambiar($tipo) . "</button>
                            </td>
                        </tr>
                    
                    </div>";
                    $contUsuarios++;
                }
                echo '</table>';
            } else {
                echo "No se encontraron resultados.";
            }
        } else {
            die('Error al preparar la consulta: ' . $con->error);
        }

        $stmt->close();
        $con->close();


        //Para que en la tabla s emuestre con una palabra el tipo de usuario, ya que en la BBDD lo tengo con numeros
        function tipo_usuario($tipo)
        {
            switch ($tipo) {
                case 1:
                    return 'Administrador';
                    break;
                case 0:
                    return 'Usuario base';
                    break;
                default:
                    return 'Tipo de usuario desconocido';
            }
        }

        //Esta funcion mostrará el cambio que se podrá hacer al darle al boton de cambiar a usuario base/administrador
        function tipo_usuario_aCambiar($tipo)
        {
            switch ($tipo) {
                case 1:
                    return 'usuario base';
                    break;
                case 0:
                    return 'administrador';
                    break;
                default:
                    return 'Tipo de usuario desconocido';
            }
        }
        ?>

    </section>



    <?php
    include 'footer.php';
    ?>

    <script>
        function ajustarFooter() {
            let contadorUsuarios = <?php echo $contUsuarios; ?>;
            let footer = document.querySelector('footer');

            if (window.innerHeight > 786 && window.innerWidth >= 400) {
                if (contadorUsuarios < 6) {
                    console.log('a');
                    console.log(contadorUsuarios);
                    footer.style.position = 'absolute';
                    footer.style.bottom = '0';
                }
            } else if (window.innerHeight <= 786) {

                if (window.innerWidth > 846 && window.innerHeight >= 723) {
                    if (contadorUsuarios < 4) {
                        console.log('b');
                        footer.style.position = 'absolute';
                        footer.style.bottom = '0';
                    }
                } else {
                    if (contadorUsuarios < 4) {
                        console.log('c');
                        footer.style.position = 'relative';
                    }
                }
            }

            if (window.innerWidth <= 400) {
                console.log('d');
                footer.style.position = 'relative';
            }
        }

        window.addEventListener('resize', ajustarFooter);
        window.addEventListener('load', ajustarFooter);
    </script>

</body>

</html>