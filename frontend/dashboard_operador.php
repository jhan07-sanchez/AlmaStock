<?php
require_once '../backend/auth/proteger.php';

if ($usuario['rol'] !== 'operador') {
    header('Location: dashboard_admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Operador | Sistema de Almacenes</title>
    <link rel="stylesheet" href="css/dashboard_operador.css">
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Operador</h2>
                <p id="usuarioNombre"></p>
            </div>
            <nav class="sidebar-nav">
                <a href="#" data-seccion="productos" class="nav-item active">
                    <span>📦</span> Consultar Productos
                </a>
                <a href="#" data-seccion="movimientos" class="nav-item">
                    <span>🔄</span> Registrar Movimiento
                </a>
                <a href="#" data-seccion="historial" class="nav-item">
                    <span>📋</span> Historial
                </a>
            </nav>
            <button id="btnCerrarSesion" class="btn btn-secondary btn-block">Cerrar Sesión</button>
        </aside>
        
        <main class="main-content">
            <header class="top-bar">
                <h1 id="tituloSeccion">Consultar Productos</h1>
                <button id="btnNuevoMovimiento" class="btn btn-primary" style="display: none;">+ Registrar Movimiento</button>
            </header>
            
            <div class="content-area">
                <!-- Sección Productos -->
                <div id="seccionProductos" class="seccion active">
                    <div class="filters-bar">
                        <input type="text" id="buscarProducto" placeholder="Buscar por nombre o código..." class="search-input">
                        <select id="filtroCategoria" class="filter-select">
                            <option value="">Todas las categorías</option>
                        </select>
                    </div>
                    <div id="tablaProductos"></div>
                </div>
                
                <!-- Sección Movimientos -->
                <div id="seccionMovimientos" class="seccion">
                    <form id="formMovimiento" class="form-card">
                        <div class="form-group">
                            <label for="movimientoProducto">Producto *</label>
                            <select id="movimientoProducto" required></select>
                            <div id="infoProducto" class="info-box" style="display: none;">
                                <p><strong>Stock Actual:</strong> <span id="stockActual">0</span></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="movimientoTipo">Tipo de Movimiento *</label>
                            <select id="movimientoTipo" required>
                                <option value="entrada">Entrada</option>
                                <option value="salida">Salida</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="movimientoCantidad">Cantidad *</label>
                            <input type="number" id="movimientoCantidad" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="movimientoMotivo">Motivo</label>
                            <input type="text" id="movimientoMotivo" placeholder="Ej: Venta, Compra, Devolución">
                        </div>
                        <div class="form-group">
                            <label for="movimientoObservaciones">Observaciones</label>
                            <textarea id="movimientoObservaciones" rows="3" placeholder="Detalles adicionales..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar Movimiento</button>
                    </form>
                </div>

                <!-- Sección Historial -->
                <div id="seccionHistorial" class="seccion">
                    <div id="tablaMovimientos"></div>
                </div>
            </div>
        </main>
    </div>

    <script src="../js/operador.js"></script>
</body>
</html>
