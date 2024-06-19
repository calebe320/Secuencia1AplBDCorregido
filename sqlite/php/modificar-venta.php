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
if (empty($_POST["categoria"])) {
    http_response_code(400);
    exit("falta insertar la nueva categoría");
}
if (empty($_POST["precio"])) {
    http_response_code(400);
    exit("falta insertar el nuevo precio");
}
if (empty($_POST["cantidad"])) {
    http_response_code(400);
    exit("falta insertar la nueva cantidad");
}
if (empty($_POST["total"])) {
    http_response_code(400);
    exit("falta insertar el nuevo total de la venta");
}

// Conexión a la base de datos
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$venta = [
    "id" => $_POST["id"],
    "nombre" => $_POST["nombre"],
    "categoria" => $_POST["categoria"],
    "precio" => $_POST["precio"],
    "cantidad" => $_POST["cantidad"],
    "total" => $_POST["total"]
];

try {
    // Preparando la consulta
    $sentencia = $conex->prepare("UPDATE ventas SET nombre=:nombre, categoria=:categoria, precio=:precio, cantidad=:cantidad, total=:total WHERE id=:id;");
    $resultado = $sentencia->execute($venta);
    
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
