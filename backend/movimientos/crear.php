<?php
require_once '../auth/proteger.php';
require_once '../auth/roles.php';
requireRol(['admin','operador']);

require_once '../config/db.php';

$producto_id = (int) $_POST['producto_id'];
$tipo        = $_POST['tipo']; // entrada | salida
$cantidad    = (int) $_POST['cantidad'];
$usuario_id  = $usuario['id'];

$conexion->begin_transaction();

try {

    // 1️⃣ Bloquear producto y obtener stock
    $q = $conexion->prepare(
        "SELECT stock FROM productos WHERE id = ? FOR UPDATE"
    );
    $q->bind_param("i", $producto_id);
    $q->execute();
    $producto = $q->get_result()->fetch_assoc();

    if (!$producto) {
        throw new Exception("Producto no existe");
    }

    $stockActual = (int) $producto['stock'];

    if ($tipo === 'salida' && $stockActual < $cantidad) {
        throw new Exception("Stock insuficiente");
    }

    $nuevoStock = ($tipo === 'entrada')
        ? $stockActual + $cantidad
        : $stockActual - $cantidad;

    // 2️⃣ Registrar movimiento
    $m = $conexion->prepare(
        "INSERT INTO movimientos (producto_id, tipo, cantidad)
         VALUES (?, ?, ?)"
    );
    $m->bind_param("isi", $producto_id, $tipo, $cantidad);
    $m->execute();

    // 3️⃣ Actualizar stock
    $u = $conexion->prepare(
        "UPDATE productos SET stock = ? WHERE id = ?"
    );
    $u->bind_param("ii", $nuevoStock, $producto_id);
    $u->execute();

    // 4️⃣ Registrar auditoría
    $accion  = "MOVIMIENTO_" . strtoupper($tipo);
    $detalle = "Producto ID $producto_id | Cantidad $cantidad";

    $a = $conexion->prepare(
        "INSERT INTO auditoria (usuario_id, accion, detalle)
         VALUES (?, ?, ?)"
    );
    $a->bind_param("iss", $usuario_id, $accion, $detalle);
    $a->execute();

    // 5️⃣ Confirmar TODO
    $conexion->commit();

    echo json_encode(['ok' => true]);

} catch (Exception $e) {

    // ❌ Revertir todo
    $conexion->rollback();

    echo json_encode([
        'ok' => false,
        'msg' => $e->getMessage()
    ]);
}

