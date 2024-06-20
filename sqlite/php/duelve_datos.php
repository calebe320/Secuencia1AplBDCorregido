<?php
include 'vars.php';

try {
    // Crear la conexión a la base de datos
    $conex = new PDO("sqlite:" . $nombre_fichero);
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener datos de la tabla de productos
    $stmt_productos = $conex->prepare('SELECT * FROM productos;');
    $stmt_productos->execute();
    $productos = $stmt_productos->fetchAll(PDO::FETCH_ASSOC);

    // Obtener datos de la tabla de distribuidores
    $stmt_distribuidores = $conex->prepare('SELECT * FROM distribuidores;');
    $stmt_distribuidores->execute();
    $distribuidores = $stmt_distribuidores->fetchAll(PDO::FETCH_ASSOC);

    // Obtener datos de la tabla de ventas
    $stmt_ventas = $conex->prepare('SELECT * FROM ventas;');
    $stmt_ventas->execute();
    $ventas = $stmt_ventas->fetchAll(PDO::FETCH_ASSOC);

    // Cerrar las consultas y la conexión
    $stmt_productos = null;
    $stmt_distribuidores = null;
    $stmt_ventas = null;
    $conex = null;

    // Devolver los datos en formato JSON
    echo json_encode([
        'productos' => $productos,
        'distribuidores' => $distribuidores,
        'ventas' => $ventas
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>

