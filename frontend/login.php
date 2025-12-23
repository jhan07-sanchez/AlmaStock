<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AlmaStock</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <form id="loginForm" class="login-box">
        <h2>Iniciar Sesion</h2>
        <input tipe="email" id="email" placeholder="Correo" required>
        <input type="password" id="password" placeholder="Contraseña" required>

        <button type="submit">Entrar</button>
        <p id="msg"></p>
    </form>

    <script src="js/auth.js"></script>
</body>
</html>