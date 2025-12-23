<?php

function registrarAuditoria(int $usuario_id, string $accion, string $detalle): void
{
    global $conexion;

    $sql = "INSERT INTO auditoria (usuario_id, accion, detalle)
            VALUES (?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iss", $usuario_id, $accion, $detalle);
    $stmt->execute();
}
