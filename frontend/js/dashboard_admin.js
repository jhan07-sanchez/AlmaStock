function cargarVista(vista) {
    fetch('/AlmaStock/frontend/views/' + vista)
        .then(res => {
            if (!res.ok) throw new Error('Vista no encontrada');
            return res.text();
        })
        .then(html => {
            document.getElementById('contenido').innerHTML = html;

            if (vista === 'productos/productos.php') {
                cargarProductos();
            }
        })
        .catch(err => console.error(err));
}



function cargarFormularioProducto() {
    fetch('http://localhost/AlmaStock/frontend/views/productos/productos_form.php')
        .then(r => r.text())
        .then(html => {
            document.getElementById('contenido').innerHTML = html;
        });
}





async function cargarAuditoria() {
    const res = await fetch("../backend/auditoria/listar.php");
    const data = await res.json();

    const tbody = document.getElementById("tablaAuditoria");
    tbody.innerHTML = "";

    if (data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4">No hay registros</td>
            </tr>
        `;
        return;
    }

    data.forEach(item => {
        tbody.innerHTML += `
            <tr>
                <td>${item.fecha}</td>
                <td>${item.usuario}</td>
                <td>${item.accion}</td>
                <td>${item.detalle}</td>
            </tr>
        `;
    });
}

// Ejecutar al cargar el dashboard
cargarAuditoria();
