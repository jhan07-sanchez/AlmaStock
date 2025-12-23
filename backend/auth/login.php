<?php
session_start();
require_once "../config/db.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT id, nombre, email, password, rol FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$usuario = $stmt->get_result()->fetch_assoc();

if ($usuario && password_verify($password, $usuario['password'])) {

    $_SESSION['usuario'] = [
        'id'     => $usuario['id'],
        'nombre' => $usuario['nombre'],
        'email'  => $usuario['email'],
        'rol'    => $usuario['rol']
    ];

    echo json_encode([
        "status" => "ok",
        "rol"    => $usuario['rol']
    ]);
    exit;
}

echo json_encode(["status" => "error"]);
