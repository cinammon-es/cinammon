/**
 * Maneja el evento de clic en el ícono del menú para alternar las clases.
 */
let menuIcon = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');
let navtree = document.querySelector('.nav-tree'); // Corrige el selector para nav-tree

menuIcon.onclick = () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
    navtree.classList.toggle('active'); // Corrige 'toogle' a 'toggle'
};



/**
 * Selecciona todas las secciones y los enlaces de navegación.
 */
let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');
let navtreelinks = document.querySelectorAll('head navtree a'); // Corrige el selector si es necesario

/**
 * Maneja el evento de desplazamiento de la ventana.
 */
window.onscroll = () => {
    sections.forEach(sec => {
        let top = window.scrollY;
        let offset = sec.offsetTop - 150;
        let height = sec.offsetHeight;
        let id = sec.getAttribute('id');

        if (top >= offset && top < offset + height) {
            navLinks.forEach(links => {
                links.classList.remove('active');
                document.querySelector('header nav a[href*=' + id + ']').classList.add('active');
            });
            // Añadir lógica similar para navtreelinks si es necesario
            navtreelinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(id)) {
                    link.classList.add('active');
                }
            });
        }
    });

    // sticky navbar //
    let header = document.querySelector('header');
    header.classList.toggle('sticky', window.scrollY > 100);

    menuIcon.classList.remove('bx-x');
    navbar.classList.remove('active');
    navtree.classList.remove('active'); // Añadir esta línea para asegurarse de que navtree también se cierre
};

/**
 * Configuración de ScrollReveal para animaciones.
 */
ScrollReveal({
    reset: true,
    distance: '80px',
    duration: 2000,
    delay: 200
});

/**
 * Revela los elementos con la clase 'home-content' y 'heading' con un retraso.
 */
ScrollReveal().reveal('.home-content, .heading', {delay: 500});
