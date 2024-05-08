<?php
include '../conexion.php';
$id = $_POST['id'];

$con = new Conexion();
$con = $con->conectar();

if ($con->connect_error) {
    die('Conexión fallida: ' . $con->connect_error);
} else {
    $delete = "delete from producto where id = ?";
    $stmt = $con->prepare($delete);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $con->error;
    }
    $stmt->close();
}

?>

