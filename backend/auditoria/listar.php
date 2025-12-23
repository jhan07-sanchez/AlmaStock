<?php
require_once __DIR__ . '/../auth/api_guard.php';
requireApiRol('admin');

require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json');

$sql = "
    SELECT
        a.fecha,
        u.nombre AS usuario,
        a.accion,
        a.detalle
    FROM auditoria a
    JOIN usuarios u ON u.id = a.usuario_id
    ORDER BY a.fecha DESC
";

$res = $conexion->query($sql);

$data = $res->fetch_all(MYSQLI_ASSOC);

echo json_encode($data);

