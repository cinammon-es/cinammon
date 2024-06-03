<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cinammon.es</title>
    <meta name="description" content="Explora nuestros servicios de hosting, VPS, Minecraft host, y más en cinammon.es. Únete a nuestro servidor de Discord para cualquier consulta.">
    <meta name="keywords" content="hosting, VPS, Minecraft host, servicios, Discord, cinammon">

    <link rel="stylesheet" href="/styling/main/style.css">
    <link rel="icon" href="/images/main/favicon.ico">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <header class="header">
        <a href="https://discord.gg/wRddFGqMdx" class="logo">cinammon.es</a>
        <i class="bx bx-menu" id="menu-icon" aria-label="Menu icon"></i>
        <nav aria-label="Main Navigation">
            <ul class="navbar">
                <li><a href="#home" class="active">Inicio</a></li>
                <li><a href="#about">Nosotros</a></li>
                <li><a href="#account">Cuenta</a></li>
                <li><a href="#services">Servicios </a>
                    <ul class="navbar-dropdown">
                        <li><a href="/services/websitehosting.php">Páginas Web</a></li>
                        <li><a href="/services/discordbotshosting.php">Bots de Discord</a></li>
                        <li><a href="/services/minecrafthosting.php">Minecraft</a></li>
                        <li><a href="/services/dedicatedservers.php">Servidores Dedicados</a></li>
                        <li><a href="/services/vpshosting.php">VPS</a></li>
                    </ul>
                </li>
                <li><a href="#billing">Facturación</a></li>
                <li><a href="#review">Reseñas</a></li>
            </ul>
        </nav>
    </header>

    <section class="home" id="home" aria-labelledby="home-title">
        <div class="home-content">
            <h3>Bienvenido a</h3>
            <h1 id="home-title"><span>cinammon.es</span></h1>
            <h3>Página web de <span>Cinammon Host</span></h3>
            <p>¡Bienvenido a cinammon.es! Explora nuestros servicios de hosting, VPS, Minecraft host, etc. Recuerda que
                tienes el servidor de Discord donde puedes hacer todo tipo de preguntas y dudas. Estamos encantados de
                tenerte en nuestra página web, ¡disfruta!</p>
            <br> <br>
            <a href="https://discord.gg/wRddFGqMdx" class="btn">Servidor de Discord</a>
        </div>
        <div class="home-img">
            <img src="https://i.ibb.co/5GFjt3x/cinammon-logo.png" alt="Imagen de bienvenida">
        </div>
    </section>

    <section class="about" id="about" aria-labelledby="about-title">
        <div class="about-img">
            <img src="https://i.ibb.co/fd9bqQD/cinammon-logo.png" alt="Sobre nosotros">
        </div>
        <div class="about-content">
            <h2 class="heading" id="about-title">¿Por qué <span>Escogernos</span>?</h2>
            <p>Ofrecemos un servicio de hosting completo, rápido e interactivo. Garantizamos continuidad sin cortes y
                contamos con personal disponible 24/7 para resolver cualquier problema. Disfruta de una experiencia de
                hosting fiable y eficiente con soporte dedicado en todo momento.</p>
            <a href="https://discord.gg/uRCTQZdgUh" class="btn">Más información</a>
        </div>
    </section>

    <section id="account" aria-labelledby="account-title">
        <div class="account">
            <h2 class="heading" id="account-title">¿Qué puedes hacer en tu <span>Cuenta</span>?</h2>
            <div class="account-container">
                <div class="account-box">
                    <i class="bx bx-user"></i>
                    <h3>Perfil</h3>
                    <p>En tu perfil podrás ver toda la información de tu cuenta, como tu correo, tu nombre, tu ID, y
                        más.</p>
                    <a href="/admin/register.php" class="btn">Ver más</a>
                </div>
                <div class="account-box">
                    <i class="bx bx-credit-card"></i>
                    <h3>Facturación</h3>
                    <p>En la sección de facturación podrás ver todas tus facturas y descargarlas en PDF.</p>
                    <a href=" /account/billing.html" class="btn">Ver más</a>
                </div>
                <div class="account-box">
                    <i class="bx bx-server"></i>
                    <h3>Servicios</h3>
                    <p>En servicios podrás ver todos los servicios que tienes contratados y la información de cada uno.</p>
                    <a href=" /account/services.html" class="btn">Ver más</a>
                </div>
                <div class="account-box">
                    <i class="bx bx-support"></i>
                    <h3>Soporte</h3>
                    <p>En soporte podrás ver todas las incidencias que has tenido y el estado de cada una.</p>
                    <a href=" /account/support.html" class="btn">Ver más</a>
                </div>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <div class="services">
            <h2 class="heading" id="services-title">Nuestros <span>Servicios</span></h2>
            <div class="services-container">
                <div class="services-box">
                    <i class="bx bx-code-alt"></i>
                    <h3>Páginas <span>Web</span></h3>
                    <p>Ofrecemos un servicio de hosting para páginas web con un 100% de uptime, baja latencia y soporte
                        dedicado
                        para resolver cualquier problema.</p>
                    <a href="/services/websitehosting.php" class="btn">Ver más</a>
                </div>
                <div class="services-box">
                    <i class="bx bx-bot"></i>
                    <h3>Bots de <span>Discord</span></h3>
                    <p>Host de bots de Discord en el lenguaje que quieras con un servicio de calidad.</p>
                    <a href=" /services/discordbotshosting.php" class="btn">Ver más</a>
                </div>
                <div class="services-box">
                    <i class="bx bx-cube"></i>
                    <h3><span>Minecraft</span> Hosting</h3>
                    <p>Host de servidores de Minecraft con un servicio de calidad.</p>
                    <a href=" /services/minecrafthosting.php" class="btn">Ver más</a>
                </div>
                <div class="services-box">
                    <i class="bx bx-podcast"></i>
                    <h3>Servidores <span>Dedicados</span></h3>
                    <p>¿No ves tu opción? Mira nuestros servidores dedicados, adaptados a lo que necesites hostear.</p>
                    <a href=" /services/dedicatedservers.php" class="btn">Ver más</a>
                </div>
                <div class="services-box">
                    <i class="bx bx-server"></i>
                    <h3><span>VPS</span> Hosting</h3>
                    <p>Con nuestras VPS podrás tener tu propio sistema para hostear lo que quieras.</p>
                    <a href=" /services/vpshosting.php" class="btn">Ver más</a>
                </div>
            </div>
    </section>

    <section class="billing" id="billing" aria-labelledby="billing-title">
        <div class="billing-content">
            <h3>Bienvenido a</h3>
            <h1 id="billing-title"><span>billing.cinammon.es</span></h1>
            <h3>Página web de ventas de <span>Cinammon Host</span></h3>
            <p>Explora nuestros servicios de hosting, VPS, Minecraft host, y más. Únete a nuestro servidor de Discord para
                cualquier consulta. Estamos encantados de tenerte aquí, ¡disfruta!</p>
            <br> <br>
            <a href="https://billing.cinammon.es" class="btn">Nuestro sistema de Financiación</a>
        </div>
        <div class="home-img">
            <img src="https://i.ibb.co/n8S3DQT/cinammon-logo3.png" alt="Imagen de facturación">
        </div>
    </section>

    <section class="review" id="review">
        <div class="team-user">
            <h2 class="heading">¿Qué dicen nuestros <span>Usuarios</span>?</h2>
        </div>
        <div class="users-container">
            <div class="user-info">
                <div class="user-banner">
                    <div class="user-background" style="background: url( https://i.imgur.com/HRBtb3F.gif) center center / cover no-repeat">
                    </div>
                    <div class="user-profile">
                        <img src="https://japi.rest/discord/v1/user/1007718032417751081/avatar" width="64px" height="64px" style="position: relative; border-radius: 100%; border: 2px solid rgb(242, 244, 251); filter: drop-shadow(rgba(0, 0, 0, 0.16) 0px 32px 72px);">
                        <a class="user-name">
                            ! Samu
                        </a>
                    </div>
                </div>
                <div class="user-job">
                    Cliente Frecuente
                </div>
                <div class="user-description">
                    ¡Me ha encantado!, Su servicio de alojamiento de bots es muy bueno: No se cae, su rendimiento hace que
                    mi bot sea bastante eficaz.
                </div>
                <div class="user-social">
                    <ul>
                        <div class="social-media">
                            <li>
                                <a href="https://discord.com/users/1007718032417751081" target="_blank"><i class="bx bxl-discord-alt"></i></a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="user-info">
                <div class="user-banner">
                    <div class="user-background" style="background: url( https://i.imgur.com/HRBtb3F.gif) center center / cover no-repeat">
                    </div>
                    <div class="user-profile">
                        <img src="https://japi.rest/discord/v1/user/807579685663146004/avatar" width="64px" height="64px" style="position: relative; border-radius: 100%; border: 2px solid rgb(242, 244, 251); filter: drop-shadow(rgba(0, 0, 0, 0.16) 0px 32px 72px);">
                        <a class="user-name">
                            Lokito
                        </a>
                    </div>
                </div>
                <div class="user-job">
                    Cliente Frecuente
                </div>
                <div class="user-description">
                    Yo poniendo "me ha encantado Es buen host y No se cae"
                </div>
                <div class="user-social">
                    <ul>
                        <div class="social-media">
                            <li>
                                <a href="https://discord.com/users/1007718032417751081" target="_blank"><i class="bx bxl-discord-alt"></i></a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </section> 

    <footer class="footer" aria-label="Footer">
        <div class="footer-text">
            <p>&copy; 2022 Cinammon. All Rights Reserved.</p>
        </div>
        <div class="footer-iconTop">
            <a href="#home"><i class="bx bx-up-arrow-alt"></i></a>
        </div>
    </footer>

    <script src="/styling/main/script.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script> 
</body>

</html>