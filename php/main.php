<?php
$title = "Cinammon.es - Tu proveedor de hosting";
$stylesheetPath = "/styling/main/style.css";
$iconPath = "/images/main/hana_not-background (1).ico";
$stylesheetIcons = "https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css";
$boxiconsVersion = "2.1.4";
?>

<?php
$menuItems = [
    ['name' => 'Inicio', 'link' => '#home', 'active' => true],
    ['name' => 'Nosotros', 'link' => '#about', 'active' => true],
    ['name' => 'Servicios', 'link' => '#services', 'active' => true],
    ['name' => 'Facturación', 'link' => '#billing', 'active' => true],
    ['name' => 'Reseñas', 'link' => '#portafolio', 'active' => true],
];
?>

<?php   
    $tituloPrincipal = "Bienvenido a";
    $nombreSitio = "cinammon.es";
    $subtitulo = "Página web de Cinammon Host";
    $descripcion = "¡Bienvenido a cinammon.es! Explora nuestros servicios de hosting, vps, minecraft host, etc. Recuerda que tienes el servidor de Discord donde puedes hacer todo tipo de preguntas y dudas. Estamos encantados de tenerte en nuestra página web, disfruta :D";
    $urlDiscord = "https://discord.gg/wRddFGqMdx";
    $imagenPrincipal = "/images/main/hana_not-background.png";
?> 

<?php
$aboutImage = "/images/main/hana 2.png";
$aboutHeading = "¿Por qué <span>Escogernos</span>?";
$aboutText = "Somos un servicio de hosting muy amplio, veloz e interactivo que no tiene ningún corte, y siempre hay personal activo para resolver todos tus problemas.";
$aboutLink = "https://discord.gg/uRCTQZdgUh";
?>

<?php
$servicios = [
    [
        'icono' => 'bx bx-code-alt',
        'titulo' => 'Páginas Web',
        'descripcion' => '',
        'enlace' => '/htmls/services/websitehosting.html'
    ],
    [
        'icono' => 'bx bx-bot',
        'titulo' => 'Bots de Discord',
        'descripcion' => 'Host de bots de Discord en el lenguaje que quieras con un servicio de calidad.',
        'enlace' => '/htmls/services/discordbotshosting.html'
    ],
    [
        'icono' => 'bx bx-cube',
        'titulo' => 'Minecraft Hosting',
        'descripcion' => 'Host de servidores de Minecraft con un servicio de calidad.',
        'enlace' => '/htmls/services/minecrafthosting.html'
    ],
    [
        'icono' => 'bx bx-podcast',
        'titulo' => 'Servidores Dedicados',
        'descripcion' => '¿No ves tu opción? Pues mira nuestros servidores dedicados donde nosotros nos adaptamos para lo que quieras hostear.',
        'enlace' => '/htmls/services/dedicatedservers.html'
    ],
    [
        'icono' => 'bx bx-server',
        'titulo' => 'VPS Hosting',
        'descripcion' => '¿Quieres ir a lo grande? No hay problema, con nuestras VPS podrás tener tu propio sistema para hostear lo que quieras.',
        'enlace' => '/htmls/services/vpshosting.html'
    ]
]; 
?>

<?php
$usuarios = [
    [
        'nombre' => '! Samu',
        'descripcion' => '¡Me ha encantado!, Su servicio de alojamiento de bots es muy bueno: No se cae, su rendimiento hace que mi bot sea bastante eficaz.',
        'imagen' => 'https://japi.rest/discord/v1/user/1007718032417751081/avatar',
        'social' => 'https://discord.com/users/1007718032417751081',
    ],
    [
        'nombre' => 'Lokito',
        'descripcion' => 'Yo poniendo "me ha encantado Es buen host y No se cae"',
        'imagen' => 'https://japi.rest/discord/v1/user/807579685663146004/avatar',
        'social' => 'https://discord.com/users/1007718032417751081',
    ],
]; ?> 