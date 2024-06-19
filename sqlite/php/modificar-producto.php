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
    exit("Falta insertar el nombre a nuevo");
}
if (empty($_POST["categoria"])) {
    http_response_code(400);
    exit("falta insertar la categoria nueva");
}
if (empty($_POST["descripcion"])) {
    http_response_code(400);
    exit("falta insertar la descripcion nueva");
}
if (empty($_POST["stock"])) {
    http_response_code(400);
    exit("falta insertar el stock nuevo");
}
if (empty($_POST["precio"])) {
    http_response_code(400);
    exit("falta insertar el precio nuevo");
}

// Conexión a la base de datos
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$producto = [
    "id" => $_POST["id"],
    "nombre" => $_POST["nombre"],
    "categoria" => $_POST["categoria"],
    "descripcion" => $_POST["descripcion"],
    "stock" => $_POST["stock"],
    "precio" => $_POST["precio"]
];

try {
    // Preparando la consulta
    $sentencia = $conex->prepare("UPDATE productos SET nombre=:nombre, categoria=:categoria, descripcion=:descripcion, stock=:stock, precio=:precio WHERE id=:id;");
    $resultado = $sentencia->execute($producto);
    
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
