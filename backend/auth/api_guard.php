<?php
header('Content-Type: application/json');
session_start();

function requireApiRol(string $rol)
{
    if (!isset($_SESSION['user_id'])) {
        echo json_encode([
            'ok' => false,
            'msg' => 'No autenticado'
        ]);
        exit;
    }

    if ($_SESSION['rol'] !== $rol) {
        echo json_encode([
            'ok' => false,
            'msg' => 'No autorizado'
        ]);
        exit;
    }
}
