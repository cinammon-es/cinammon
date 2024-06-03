let menuIcon = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');
let navtree = document.querySelector('nav-tree')
menuIcon.onclick = () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
    navtree.classList.toogle('active');
};


// ****** //
let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');
let navtreelinks = document.querySelectorAll('head navtree a')

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
        }
        ;

    });
    // sticky navbar //
    let header = document.querySelector('header');

    header.classList.toggle('sticky', window.scrollY > 100);

    // *********************************************** //
    menuIcon.classList.remove('bx-x');
    navbar.classList.remove('active');
};

// *************************************************** //
ScrollReveal({
    reset: true,
    distance: '80px',
    duration: 2000,
    delay: 200
});

ScrollReveal().reveal('.home-content, .heading', {delay: 500});