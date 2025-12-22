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

