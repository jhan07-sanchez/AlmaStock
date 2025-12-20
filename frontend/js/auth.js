document.getElementById("loginForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const data = new FormData();
    data.append("email", email.value);
    data.append("password", password.value);

    const res = await fetch("../backend/auth/login.php", {
        method: "POST",
        body: data
    });

    const result = await res.json();

    if (result.status === "ok") {
        if (result.rol === "admin") {
            window.location.href = "dashboard_admin.html";
        } else {
            window.location.href = "dashboard_operador.html";
        }
    } else {
        document.getElementById("msg").innerText = "Credenciales incorrectas";
    }
});
