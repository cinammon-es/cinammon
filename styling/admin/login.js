document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM completamente cargado y analizado");

    const form = document.getElementById("loginForm");
    const username = document.getElementById("username");
    const password = document.getElementById("password");

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        console.log("Enviando formulario...");

        if (!username.value || !password.value) {
            console.log("Todos los campos son obligatorios");
            return;
        }

        const data = {
            username: username.value,
            password: password.value,
        };

        console.log(data);

        fetch("http://localhost:3000/admin/login.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then((data) => {
            console.log(data);
            if (data.error) {
                const errorElement = document.querySelector('.error');
                errorElement.textContent = data.message;
                console.log(data.message);
                return;
            }

            const token = data.token;
            localStorage.setItem("token", token);
            window.location.href = "http://localhost:3000/admin/dashboard.php";
        })
        .catch((error) => {
            console.error("Error:", error);
            const errorElement = document.querySelector('.error');
            errorElement.textContent = "Error en la solicitud de inicio de sesión.";
        });
    });
});