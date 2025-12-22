console.log('productos.js CARGADO');

function cargarProductos() {
    fetch('http://localhost/AlmaStock/backend/productos/listar.php')
        .then(r => r.json())
        .then(data => {
            let html = `
                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Stock</th>
                        <th>Stock Mínimo</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
            `;

            data.forEach(p => {
                html += `
                    <tr>
                        <td>${p.nombre}</td>
                        <td>${p.codigo}</td>
                        <td>${p.stock}</td>
                        <td>${p.stock_minimo}</td>
                        <td>${p.precio}</td>
                        <td>
                            <button onclick="editarProducto(${p.id})">✏️</button>
                            <button onclick="eliminarProducto(${p.id})">🗑️</button>
                        </td>
                    </tr>
                `;
            });

            html += '</table>';

            document.getElementById('zonaProductos').innerHTML = html;
        });
}




function editarProducto(id) {
    fetch(`/AlmaStock/backend/productos/obtener.php?id=${id}`)
        .then(r => r.json())
        .then(p => {
            cargarFormularioProducto();

            const interval = setInterval(() => {
                const inputId = document.getElementById('id');
                if (!inputId) return;

                clearInterval(interval);

                inputId.value = p.id;
                document.getElementById('nombre').value = p.nombre;
                document.getElementById('codigo').value = p.codigo;
                document.getElementById('stock').value = p.stock;
                document.getElementById('stock_minimo').value = p.stock_minimo;
                document.getElementById('precio').value = p.precio;

                console.log('EDITANDO ID:', p.id);
            }, 50);
        })
        .catch(err => console.error('ERROR EDITAR:', err));
}



function eliminarProducto(id) {
    if (!confirm('¿Eliminar producto?')) return;

    fetch('/AlmaStock/backend/productos/eliminar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${encodeURIComponent(id)}`
    })
    .then(r => r.json())
    .then(resp => {
        if (resp.ok) {
            cargarProductos();
        } else {
            alert(resp.msg || 'No se pudo eliminar');
        }
    })
    .catch(err => console.error(err));
}





document.addEventListener('submit', function (e) {
    const form = e.target.closest('#formProductos');
    if (!form) return;

    e.preventDefault();

    console.log('SUBMIT DETECTADO');

    const datos = new FormData(form);
    const id = datos.get('id');

    if (!id) {
        datos.delete('id'); // crear
    }

    const url = id
        ? '/AlmaStock/backend/productos/actualizar.php'
        : '/AlmaStock/backend/productos/crear.php';

    console.log('ENVIANDO A:', url);
    console.log('DATOS:', Object.fromEntries(datos));

    fetch(url, {
        method: 'POST',
        body: datos
    })
    .then(r => r.json())
    .then(res => {
        console.log('RESPUESTA:', res);

        if (res.ok) {
            cargarVista('productos/productos.php');
        } else {
            alert(res.msg || 'Error');
        }
    })
    .catch(err => console.error('ERROR:', err));
});


