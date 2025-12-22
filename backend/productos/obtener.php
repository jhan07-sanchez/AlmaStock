<?php
header('Content-Type: application/json');
require_once '../config/db.php';

if (!isset($_GET['id'])) {
    echo json_encode(['ok' => false, 'msg' => 'ID no enviado']);
    exit;
}

$id = (int) $_GET['id'];

$sql = "SELECT id, nombre, codigo, stock, stock_minimo, precio
        FROM productos
        WHERE id = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$producto = $result->fetch_assoc();

echo json_encode($producto);
