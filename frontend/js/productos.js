document.getElementById("formProductos").addEventListener("sumit", async (e) => {

    e.preventDefault()

    const data = new FormData();
    data.append("nombre", nombre.value);
    data.append("codigo", codigo.value);
    data.append("precio", precio.value);

    await fetch("../backend/productos/crear.php",{
        method: "POST",
        body: data
    });

    elert("Producto guardado");

});