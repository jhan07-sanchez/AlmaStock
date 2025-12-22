<?php
require_once __DIR__ . '/../config/db.php';

// TOTAL PRODUCTOS
$q1 = $conexion->query("SELECT COUNT(*) total FROM productos");
$totalProductos = $q1->fetch_assoc()['total'] ?? 0;

// STOCK BAJO: stock menor o igual al stock mínimo de cada producto
$q2 = $conexion->query("SELECT COUNT(*) AS total FROM productos WHERE stock <= stock_minimo");
$stockBajo = $q2->fetch_assoc()['total'] ?? 0;


// VALOR TOTAL INVENTARIO
$q3 = $conexion->query("SELECT SUM(stock * precio) total FROM productos");
$valorTotal = $q3->fetch_assoc()['total'] ?? 0;

// MOVIMIENTOS HOY
$q4 = $conexion->query("
    SELECT COUNT(*) total
    FROM movimientos
    WHERE DATE(fecha) = CURDATE()
");
$movimientosHoy = $q4->fetch_assoc()['total'] ?? 0;
