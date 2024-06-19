<?php
include 'vars.php';

// Permitir solicitudes desde cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Verificar si vienen los parametros requeridos
if (empty($_POST["id"])) {
    http_response_code(400);
    exit("Falta insertar el id a eliminar"); // Terminar el script definitivamente
}

// Conexión a la base de datos
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ID de la venta a eliminar
$id_venta = $_POST["id"];

try {
    // Preparando la consulta
    $sentencia = $conex->prepare("DELETE FROM ventas WHERE id = :id");
    $sentencia->bindParam(':id', $id_venta);
    $resultado = $sentencia->execute();

    // Verificar si se eliminó la venta correctamente
    if ($resultado) {
        http_response_code(200);
        echo "Datos eliminados";
    } else {
        http_response_code(400);
        echo "No se pudo eliminar la venta";
    }

} catch (PDOException $exc) {
    http_response_code(400);
    echo "Lo siento, ocurrió un error: " . $exc->getMessage();
}
?>
