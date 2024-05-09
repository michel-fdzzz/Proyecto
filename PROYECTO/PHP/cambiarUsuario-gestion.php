<?php
include '../conexion.php';
$id = $_POST['id'];
$tipo = $_POST['tipo']

$con = new Conexion();
$con = $con->conectar();

if ($con->connect_error) {
    die('Conexión fallida: ' . $con->connect_error);
} else {


    
    $update = "UPDATE usuario SET tipo = ? WHERE id = ?";
    $stmt = $con->prepare($update);

    //Si el usuario es admin se cambia a base
    if ($tipo == 1){
        $tipo = 0;
    //Si el usuario es base se cambia a admin
    } else {
        $tipo = 1;
    }
    $stmt->bind_param("ii", $tipo, $id);
    
    if ($stmt->execute()) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $con->error;
    }
    $stmt->close();
}

?>

