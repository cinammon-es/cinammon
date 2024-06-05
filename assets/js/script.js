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
 */document.addEventListener('DOMContentLoaded', () => {
    let scrollToTopIcon = document.querySelector('.footer-iconTop a');

    if (scrollToTopIcon) {
        scrollToTopIcon.onclick = (event) => {
            event.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };
    }
});
