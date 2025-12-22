<?php
require_once __DIR__ . '/../config/db.php';

$sql = "
    SELECT 
        p.nombre AS producto,
        m.tipo,
        m.cantidad
    FROM movimientos m
    JOIN productos p ON p.id = m.producto_id
    ORDER BY m.fecha DESC
    LIMIT 5
";

$result = $conexion->query($sql);

$movimientos = [];

while ($row = $result->fetch_assoc()) {
    $movimientos[] = $row;
}
