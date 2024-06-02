document.addEventListener('DOMContentLoaded', function() {
    // Selecciona todos los enlaces de navegación
    const navLinks = document.querySelectorAll('.sidebar nav ul li a');
    // Añade un event listener a cada enlace
    navLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            // Quita la clase 'active' de todos los enlaces
            navLinks.forEach(link => link.classList.remove('active'));
            // Añade la clase 'active' al enlace clicado
            this.classList.add('active');
            // Oculta todas las secciones
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.classList.remove('active'));
            // Muestra la sección correspondiente
            const targetId = this.getAttribute('href').substring(1);
            document.getElementById(targetId).classList.add('active');
        });
    });
    // Mostrar la primera sección por defecto
    document.querySelector('.section').classList.add('active');
}); 
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('exampleChart').getContext('2d');
    var exampleChart = new Chart(ctx, {
        type: 'bar', // Tipo de gráfico
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Usuarios Registrados',
                data: [10, 20, 30, 40, 50, 60], // Datos de ejemplo
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});



const form = document.querySelector('form');
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const response = await fetch(' /db/update-profile.php', {
        method: 'POST',
        body: formData
    });
    const data = await response.json();
    if (data.success) {
        alert(data.message);
    } else {
        alert(data.message);
    }
}); 

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const response = await fetch(' /db/delete-user.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();
        if (data.success) {
            alert(data.message);
        } else {
            alert(data.message);
        }
    });
});