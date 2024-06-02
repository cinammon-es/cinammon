// Selección de elementos
let menuIcon = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');
let navtree = document.querySelector('.nav-tree'); // Asegúrate de que este selector coincide con tu HTML

menuIcon.onclick = () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
    navtree.classList.toggle('active'); // Corrección de 'toogle' a 'toggle'
};

// Selección de secciones y enlaces de navegación
let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');
let navtreelinks = document.querySelectorAll('.nav-tree a'); // Corrección del selector

window.onscroll = () => {
    sections.forEach(sec => {
        let top = window.scrollY;
        let offset = sec.offsetTop - 150;
        let height = sec.offsetHeight;
        let id = sec.getAttribute('id');

        if (top >= offset && top < offset + height) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                document.querySelector('header nav a[href*=' + id + ']').classList.add('active');
            });

            navtreelinks.forEach(link => { // Lógica adicional para navtreelinks
                link.classList.remove('active');
                document.querySelector('.nav-tree a[href*=' + id + ']').classList.add('active');
            });
        }
    });

    // Sticky navbar
    let header = document.querySelector('header');
    header.classList.toggle('sticky', window.scrollY > 100);

    // Cerrar menú al hacer scroll
    menuIcon.classList.remove('bx-x');
    navbar.classList.remove('active');
    navtree.classList.remove('active');
};
