<?php
header('Content-Type: application/json');

require_once '../config/db.php';

$sql = "SELECT id, nombre, codigo, stock, stock_minimo, precio FROM productos";
$result = $conexion->query($sql);

$productos = [];

while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

echo json_encode($productos);
