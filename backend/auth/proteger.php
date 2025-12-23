<?php
session_start();

// Verificación de sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../frontend/login.php');
    exit;
}

// Usuario disponible para todo el sistema
$usuario = $_SESSION['usuario'];
