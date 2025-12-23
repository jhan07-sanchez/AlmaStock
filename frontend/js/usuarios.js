document.addEventListener("submit", function (e) {

    if (e.target.id !== "formUsuario") return;

    e.preventDefault();
    console.log("SUBMIT FORM USUARIO OK");

    const data = new FormData(e.target);

    fetch("../backend/usuarios/crear.php", {
        method: "POST",
        body: data
    })
    .then(res => {
        console.log("STATUS:", res.status);
        return res.json(); // AHORA SÍ
    })
    .then(res => {
        console.log("RESPUESTA JSON:", res);

        const msg = document.getElementById("msgUsuario");

        if (res.ok) {
            msg.innerText = "✅ Usuario creado correctamente";
            msg.style.color = "green";
            e.target.reset();
        } else {
            msg.innerText = "❌ " + (res.msg || "Error");
            msg.style.color = "red";
        }
    })
    .catch(err => {
        console.error("ERROR FETCH:", err);
    });
});

