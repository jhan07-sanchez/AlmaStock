<?php
require_once '../config/db.php';

$id = $_POST['id'];

$sql = "DELETE FROM productos WHERE id=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(['ok' => true]);
