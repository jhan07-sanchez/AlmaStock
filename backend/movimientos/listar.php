<?php
require_once '../auth/proteger.php';
require_once '../auth/roles.php';
requireRol('admin');

require_once '../config/db.php';

$sql = "
SELECT
    m.fecha,
    p.nombre AS producto,
    m.tipo,
    m.cantidad,
    u.nombre AS usuario
FROM movimientos m
JOIN productos p ON p.id = m.producto_id
JOIN usuarios u ON u.id = m.usuario_id
ORDER BY m.fecha DESC
";

$result = $conexion->query($sql);
$movimientos = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($movimientos);
