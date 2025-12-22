<?php
header('Content-Type: application/json');
require_once '../config/db.php';

$id     = $_POST['id']     ?? null;
$nombre = $_POST['nombre'] ?? null;
$codigo = $_POST['codigo'] ?? null;
$stock  = $_POST['stock']  ?? null;
$stock_minimo  = $_POST['stock_minimo']  ?? null;
$precio = $_POST['precio'] ?? null;

if (!$id || !$nombre || !$codigo || !$stock || !$stock_minimo || !$precio) {
    echo json_encode(['ok' => false, 'msg' => 'Datos incompletos']);
    exit;
}

$sql = "UPDATE productos
        SET nombre=?, codigo=?, stock=?, stock_minimo=?, precio=?
        WHERE id=?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssiidi", $nombre, $codigo, $stock, $stock_minimo, $precio, $id);
$stmt->execute();

echo json_encode(['ok' => true]);



