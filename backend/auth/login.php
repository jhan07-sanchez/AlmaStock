<?php
session_start();
include("../config/db.php");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if ($usuario && password_verify($password, $usuario['password'])) {
    $_SESSION['user_id'] = $usuario['id'];
    $_SESSION['rol'] = $usuario['rol'];

    echo json_encode([
        "status" => "ok",
        "rol" => $usuario['rol']
    ]);
} else {
    echo json_encode(["status" => "error"]);
}
