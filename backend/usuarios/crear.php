<?php
ob_start();

require_once __DIR__ . '/../auth/api_guard.php';
requireApiRol('admin');

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../auditoria/registrar.php';

header('Content-Type: application/json');


$nombre = trim($_POST['nombre'] ?? '');
$email  = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$rol = $_POST['rol'] ?? '';

if ($nombre === '' || $email === '' || $password === '' || $rol === '') {
    echo json_encode(['ok' => false, 'msg' => 'Datos incompletos']);
    exit;
}

// Hashear contraseña (obligatorio)
$passwordHash = password_hash($password, PASSWORD_BCRYPT);

// Validar email único
$check = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(['ok' => false, 'msg' => 'El email ya existe']);
    exit;
}

// Insertar usuario
$sql = "INSERT INTO usuarios (nombre, email, password, rol)
        VALUES (?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssss", $nombre, $email, $passwordHash, $rol);

if ($stmt->execute()) {

    registrarAuditoria(
        $_SESSION['user_id'],
        'CREAR_USUARIO',
        "Creó usuario: $email (rol: $rol)"
    );

    echo json_encode(['ok' => true]);
} else {
    echo json_encode(['ok' => false, 'msg' => 'No se pudo crear el usuario']);
}
