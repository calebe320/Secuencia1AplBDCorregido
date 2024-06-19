<?php
include 'vars.php';

// Permitir solicitudes desde cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Verificar si vienen los parametros requeridos
if (empty($_POST["nombre"])) {
    http_response_code(400);
    exit("Falta insertar el nombre");
}

if (empty($_POST["telefono"])) {
    http_response_code(400);
    exit("falta insertar el telefono");
}
if (empty($_POST["direccion"])) {
    http_response_code(400);
    exit("falta insertar la direccion");
}
if (empty($_POST["correo"])) {
    http_response_code(400);
    exit("falta insertar el correo");
}

// Conexión a la base de datos
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$distribuidor = [
    "nombre" => $_POST["nombre"],
    "telefono" => $_POST["telefono"],
    "direccion" => $_POST["direccion"],
    "correo" => $_POST["correo"]
];

try {
    // Preparando la consulta
    $sentencia = $conex->prepare("INSERT INTO distribuidores (nombre, telefono, direccion, correo) VALUES (:nombre, :telefono, :direccion, :correo);");
    $resultado = $sentencia->execute($distribuidor);
    
    if ($resultado) {
        http_response_code(200);
        echo "Datos insertados";
    } else {
        http_response_code(400);
        echo "No se pudieron insertar los datos";
    }
} catch (PDOException $exc) {
    http_response_code(400);
    echo "Lo siento, ocurrió un error: " . $exc->getMessage();
}
?>
