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
    ?>

    <section class="main">
            
    <?php
    $con = new Conexion();
    $con = $con->conectar();
    // Preparar la consulta SQL
    $select = "SELECT correoElectronico, tipo, id 
            FROM usuario
            ORDER BY correoElectronico ASC";
    $stmt = $con->prepare($select);

    // Verificar si la consulta se preparó correctamente
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
                // Acceder a los valores de cada columna
                $correo = $fila['correoElectronico'];
                $tipo = $fila['tipo'];
                $id = $fila['id'];

                // Haz lo que necesites hacer con los datos de cada fila
                // Por ejemplo, puedes imprimirlos en pantalla
                echo "
                <tr>
                    <td>$correo</td>
                    <td>".tipo_usuario($tipo)."</td>
                    <td>
                        <button onclick='eliminarUsuario($id)'>Eliminar</button>
                    </td>
                    <td>
                        <button onclick='cambiar_tipo_usuario($id, $tipo)'>Cambiar a ".tipo_usuario_aCambiar($tipo)."</button>
                    </td>
                </tr>
               
            </div>";
            }
            echo '</table>';
        } else {
            echo "No se encontraron resultados.";
        }
    } else {
        // Si la consulta no se preparó correctamente, muestra un mensaje de error
        die('Error al preparar la consulta: ' . $con->error);
    }

    $stmt->close();
    $con->close();


    //Para que en la tabla s emuestre con una palabra el tipo de usuario, ya que en la BBDD lo tenog con numeros
    function tipo_usuario($tipo){
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
    function tipo_usuario_aCambiar($tipo){
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

</body>
</html>