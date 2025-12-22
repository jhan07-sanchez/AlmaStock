<?php
header('Content-Type: application/json');
require_once '../config/db.php';

$nombre = trim($_POST['nombre'] ?? '');
$codigo = trim($_POST['codigo'] ?? '');
$stock  = isset($_POST['stock']) ? (int) $_POST['stock'] : null;
$stock_minimo  = isset($_POST['stock_minimo']) ? (int) $_POST['stock_minimo'] : null;
$precio = isset($_POST['precio']) ? (float) $_POST['precio'] : null;

if ($nombre === '' || $codigo === '' || $stock === null || $stock_minimo === null || $precio === null) {
    echo json_encode(['ok' => false, 'msg' => 'Datos incompletos']);
    exit;
}

$sql = "INSERT INTO productos (nombre, codigo, stock, stock_minimo, precio)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssiid", $nombre, $codigo, $stock, $stock_minimo, $precio);
if ($stmt->execute()) {
    echo json_encode(['ok' => true]);
} else {
    echo json_encode(['ok' => false, 'msg' => 'No se pudo crear']);
}

