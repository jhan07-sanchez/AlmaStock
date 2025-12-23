<section class="card">
    <h3>👤 Crear Usuario</h3>

    <form id="formUsuario">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contraseña" required>

        <select name="rol" required>
            <option value="">Seleccione rol</option>
            <option value="admin">Administrador</option>
            <option value="operador">Operador</option>
        </select>

        <button type="submit">Crear Usuario</button>
    </form>

    <p id="msgUsuario"></p>
</section>
