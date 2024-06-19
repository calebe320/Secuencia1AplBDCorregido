<?php
include 'vars.php';

// Permitir solicitudes desde cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Verificar si vienen los parámetros requeridos
if (empty($_POST["id"])) {
    http_response_code(400);
    exit("Falta insertar el id a cambiar");
}
if (empty($_POST["nombre"])) {
    http_response_code(400);
    exit("Falta insertar el nuevo nombre");
}
if (empty($_POST["telefono"])) {
    http_response_code(400);
    exit("falta insertar el nuevo telefono");
}
if (empty($_POST["direccion"])) {
    http_response_code(400);
    exit("falta insertar la nueva direccion");
}
if (empty($_POST["correo"])) {
    http_response_code(400);
    exit("falta insertar el nuevo correo");
}

// Conexión a la base de datos
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$distribuidor = [
    "id" => $_POST["id"],
    "nombre" => $_POST["nombre"],
    "telefono" => $_POST["telefono"],
    "direccion" => $_POST["direccion"],
    "correo" => $_POST["correo"]
];

try {
    // Preparando la consulta
    $sentencia = $conex->prepare("UPDATE distribuidores SET nombre=:nombre, telefono=:telefono, direccion=:direccion, correo=:correo WHERE id=:id;");
    $resultado = $sentencia->execute($distribuidor);
    
    if ($resultado) {
        http_response_code(200);
        echo "Datos actualizados";
    } else {
        http_response_code(400);
        echo "No se pudieron actualizar los datos";
    }
} catch (PDOException $exc) {
    http_response_code(400);
    echo "Lo siento, ocurrió un error: " . $exc->getMessage();
}
?>
