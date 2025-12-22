<?php
require_once '../backend/auth/proteger.php';
require_once '../backend/dashboard/kpis.php';
require_once '../backend/dashboard/movimientos_recientes.php';
require_once '../backend/dashboard/alertas_stock.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | StockPro</title>
    <link rel="stylesheet" href="css/dashboard_admin.css">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2 class="logo">StockPro</h2>

        <nav>
            <a class="active" href="dashboard_admin.php">Dashboard</a>
            <a href="#" onclick="cargarVista('productos/productos.php')">Productos</a>
            <a href="movimientos.php">Movimientos</a>
            <a href="usuarios.php">Usuarios</a>
            <a href="configuracion.php">Configuración</a>
        </nav>

        <div class="role">
            <button class="btn active">Admin</button>
            <button class="btn">Operador</button>
        </div>

        <a href="logout.php" class="logout">Cerrar sesión</a>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="content" id="contenido">


        <!-- TOPBAR -->
        <header class="topbar">
            <input type="text" placeholder="Buscar productos, SKU...">

            <div class="user">
               <span><?= htmlspecialchars($usuario['nombre']) ?></span>
               <small><?= htmlspecialchars($usuario['email']) ?></small>
           </div>
        </header>


        <!-- KPIs -->
        <section class="cards">

            <div class="card">
                <h4>Total Productos</h4>
                <p class="number">
                    <?= $totalProductos ?? 0 ?>
                </p>
            </div>

            <div class="card warning">
                <h4>Stock Bajo</h4>
                <p class="number">
                    <?= $stockBajo ?? 0 ?>
                </p>
            </div>

            <div class="card money">
                <h4>Valor Total</h4>
                <p class="number">
                    $<?= isset($valorTotal) ? number_format($valorTotal, 2, ',', '.') : '0,00' ?>
                </p>
            </div>

            <div class="card success">
                <h4>Movimientos Hoy</h4>
                <p class="number">
                    <?= $movimientosHoy ?? 0 ?>
                </p>
            </div>

        </section>

        <!-- MOVIMIENTOS RECIENTES -->
        <section class="box">
            <h3>Movimientos Recientes</h3>

            <?php if (!empty($movimientos)): ?>
                <?php foreach ($movimientos as $mov): ?>
                    <div class="movement">
                        <strong><?= htmlspecialchars($mov['producto']) ?></strong>
                        <span class="<?= $mov['tipo'] === 'entrada' ? 'green' : 'red' ?>">
                            <?= $mov['cantidad'] ?> <?= ucfirst($mov['tipo']) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay movimientos registrados.</p>
            <?php endif; ?>
        </section>

        <!-- ALERTAS STOCK BAJO -->
        <section class="box">
            <h3>Alertas de Stock Bajo</h3>

            <?php if (!empty($alertasStock)): ?>
                <?php foreach ($alertasStock as $alerta): ?>
                    <div class="alert <?= $alerta['porcentaje'] < 20 ? 'danger' : '' ?>">
                        <p><?= htmlspecialchars($alerta['producto']) ?></p>

                        <div class="bar">
                            <span style="width:<?= $alerta['porcentaje'] ?>%"></span>
                        </div>

                        <small>
                            <?= $alerta['stock'] ?> / <?= $alerta['minimo'] ?>
                        </small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay alertas de stock.</p>
            <?php endif; ?>
        </section>

    </main>
    <script src="js/dashboard_admin.js"></script>
    <script src="js/productos.js"></script>
</div>
</body>
</html>

