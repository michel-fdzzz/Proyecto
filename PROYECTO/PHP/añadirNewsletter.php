<?php
include 'conexion.php';
$con = new Conexion();
$con = $con->conectar();

$correo = $_POST['correo'];
$response = false;

if ($con->connect_error) {
    die('Conexión fallida: ' . $con->connect_error);
} else {
    // Comprobar si el correo electrónico existe en la tabla usuario
    $select = 'SELECT correoElectronico FROM usuario WHERE correoElectronico = ?';
    $stmt1 = $con->prepare($select);

    if ($stmt1) {
        $stmt1->bind_param('s', $correo);
        $stmt1->execute();
        $rest = $stmt1->get_result();

        if ($rest->num_rows > 0) {
            // Comprobar si el correo electrónico existe
            $select = 'SELECT correoElectronico FROM usuario WHERE correoElectronico = ?';
            $stmt2 = $con->prepare($select);

            if ($stmt2) {
                $stmt2->bind_param('s', $correo);
                $stmt2->execute();
                $rest = $stmt2->get_result();

                if ($rest->num_rows > 0) {
                    // Actualizar el newsletter a true
                    $insert = 'UPDATE usuario set newsletter = ? WHERE correoElectronico = ?';
                    $stmt3 = $con->prepare($insert);

                    if ($stmt3) {
                        $newsletter_true = 1;
                        $stmt3->bind_param('is', $newsletter_true, $correo);
                        if ($stmt3->execute()) {
                            $response = true;
                        }
                        $stmt3->close();
                    }
                }
                $stmt2->close();
            }
        }
        $stmt1->close();
    }
    $con->close();
}
echo json_encode($response);
?>