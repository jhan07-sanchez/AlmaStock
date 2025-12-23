<?php
/**
 * Middleware de roles
 * Uso: requireRol('admin') o requireRol(['admin','operador'])
 */

function requireRol($rolesPermitidos) {

    if (!isset($_SESSION['usuario'])) {
        header('Location: ../../frontend/login.php');
        exit;
    }

    $rolUsuario = $_SESSION['usuario']['rol'];

    // Convertimos a array por si llega un string
    if (!is_array($rolesPermitidos)) {
        $rolesPermitidos = [$rolesPermitidos];
    }

    if (!in_array($rolUsuario, $rolesPermitidos)) {
        http_response_code(403);
        echo json_encode([
            'ok' => false,
            'msg' => 'Acceso denegado'
        ]);
        exit;
    }
}
