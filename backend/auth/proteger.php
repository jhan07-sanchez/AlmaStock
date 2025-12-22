<?php
session_start();

// 1. Verificación de seguridad
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../frontend/login.php');
    exit();
}

// 2. Importar conexión (ajusta la ruta según tu estructura)
require_once __DIR__ . '/../config/db.php';

$user_id = $_SESSION['user_id'];

// 3. Obtener datos del usuario
$query = mysqli_query($conexion, "SELECT nombre, email, rol FROM usuarios WHERE id = '$user_id'");

// 4. Guardar los datos en la variable $usuario que usas en el HTML
$usuario = mysqli_fetch_assoc($query);

// 5. Verificación extra: Si por alguna razón no existe el usuario en la DB
if (!$usuario) {
    session_destroy();
    header('Location: ../../frontend/login.php');
    exit();
}