<?php
require_once __DIR__ . '/../config/db.php';

$sql = "
    SELECT
        nombre AS producto,
        stock,
        stock_minimo AS minimo,
        ROUND((stock / stock_minimo) * 100) AS porcentaje
    FROM productos
    WHERE stock <= stock_minimo
    ORDER BY porcentaje ASC
    LIMIT 5
";

$result = $conexion->query($sql);

$alertasStock = [];

while ($row = $result->fetch_assoc()) {
    $alertasStock[] = $row;
}
