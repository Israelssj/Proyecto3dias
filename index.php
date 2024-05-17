<?php
session_start(); // Iniciar la sesión del usuario
$usuarioLogueado = false;
$rol = '';

// Verificar si el usuario está logueado y establecer las variables correspondientes
if (isset($_SESSION['nombre_usuario'])) {
    $usuarioLogueado = true;
    $rol = $_SESSION['rol'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>3 días</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <style>
       
        .header {
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .slider_section {
            margin-top: 0;
            padding-top: 0;
        }
        
        .location_section .left_side {
            text-align: left;
        }
        .location_section .right_side {
            text-align: left;
        }
        .btn-sesion {
            background-color: #102B3E;
            color: white;
            border: none;
            padding: 7px 20px;
            border-radius: 5px;
        }
        .btn-sesion:hover {
            background-color: #1CC8A0;
        }
        .dropdown-menu {
            left: -50px;
        }
        .product_detail h5 {
            color: white;
        }
        /* Estilos para las cards */
        .product_box {
            background-color: #102B3E;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product_img img {
            width: 100%;
            border-radius: 8px;
            height: 200px; 
            object-fit: cover; 
        }
        .product_detail {
            text-align: center;
            margin-top: 10px;
            flex-grow: 1;
        }
        .product_detail h5 {
            margin: 10px 0;
            color: white;
        }
    </style>
</head>
<body>
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a class="nav-link" href="#inicio">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="productos.php">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="#ubicacion">Ubicación</a></li>
                <li class="nav-item"><a class="nav-link" href="#acerca-de">Acerca de</a></li>
            </ul>
            <?php if ($usuarioLogueado): ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-sesion dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['nombre_usuario']; ?>
                    </button>
                    <div class="dropdown-menu">
                        <?php if ($rol == 'admin'): ?>
                            <a class="dropdown-item" href="admin_dashboard.php">Administracion</a>
                        <?php elseif ($rol == 'usuario'): ?>
                            <a class="dropdown-item" href="usuario_dashboard.php">Menu Restaurante</a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
                    </div>
                </div>
            <?php else: ?>
                <a class="btn btn-sesion" href="login.php">Iniciar sesión</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<section id="inicio" class="slider_section" style="background-color: #102B3E;">
    <div id="main_slider" class="carousel slide banner-main" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide" src="images/banner2.jpg" alt="First slide">
                <div class="container">
                    <div class="carousel-caption relative">
                        <h1>Acerca <br><strong class="black_bold">De </strong><br>
                            <strong class="yellow_bold">Nosotros </strong></h1>
                        <p>¡Bienvenido al Proyecto en 3 días! <br>
                            Disfruta de nuestras exquisitas especialidades de mariscos en un ambiente único. <br>
                            Con más de 20 años de experiencia en la industria.</p>
                        <a href="productos.php">Productos que ofrecemos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="productos" class="product_section layout_padding" style="background-color: #CED8E1;">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Nuestros Productos</h2>
        </div>
        <div class="row" id="productos-list">
            <!-- Productos cargados cor JavaScript -->
        </div>
    </div>
</section>

<section id="ubicacion" class="location_section layout_padding">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-md-6 left_side">
                <div class="info">
                    <h2>Nuestro Restaurante</h2>
                    <p>
                        Disfruta de los sabores del mar en un ambiente acogedor. Nuestros platos son cuidadosamente preparados con ingredientes frescos para brindarte una experiencia culinaria única. Ven y prueba nuestra deliciosa variedad de mariscos y pescados frescos de la región.
                    </p>
                </div>
                <div class="restaurant_image">
                    <img src="images/restaurante.jpg" alt="Restaurante">
                </div>
            </div>
            <div class="col-md-6 right_side">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.3374933561176!2d-99.17403012402943!3d19.397818641789293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ff7769001035%3A0x8908d745e6168858!2sTuring%20-%20Inteligencia%20Artificial!5e0!3m2!1ses-419!2smx!4v1715808015508!5m2!1ses-419!2smx" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="location_detail">
                    <h5>Dirección:</h5>
                    <p>Av. Insurgentes Sur 601, Nápoles, Benito Juárez, 03810 Ciudad de México, CDMX</p>
                    <h5>Horario de Atención:</h5>
                    <p>Lunes a Viernes: 9:00 am - 7:00 pm</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="acerca-de" class="info_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="info_box">
                <h5>Sobre Nosotros</h5>
                <ul>
                    <li><i class="fa fa-check"></i> Historia del restaurante: Fundado en 2000, nuestro restaurante ha sido un lugar emblemático para los amantes de los mariscos. Con más de 20 años de experiencia, nos enorgullecemos de ofrecer platos exquisitos preparados con los ingredientes más frescos.</li>
                    <li><i class="fa fa-check"></i> Valores y cultura: Nuestra filosofía se basa en la calidad, la innovación y el compromiso con el medio ambiente. Valoramos la sostenibilidad y nos esforzamos por minimizar nuestro impacto ambiental.</li>
                    <li><i class="fa fa-check"></i> Equipo y liderazgo: Contamos con un equipo de chefs altamente calificados y un personal dedicado que se esfuerza por brindar una experiencia culinaria excepcional a nuestros clientes. Nuestro liderazgo inspira a todos a dar lo mejor de sí mismos cada día.</li>
                </ul>
            </div>
            <div class="info_box info_box_center">
                <h5>Nuestra Misión</h5>
                <ul>
                    <li><i class="fa fa-check"></i> Compromiso con la calidad: Utilizamos los mejores ingredientes y técnicas de cocina para ofrecer platos de la más alta calidad a nuestros clientes.</li>
                    <li><i class="fa fa-check"></i> Sostenibilidad: Nos esforzamos por reducir nuestro impacto ambiental a través de prácticas sostenibles y el uso de productos locales y orgánicos.</li>
                    <li><i class="fa fa-check"></i> Satisfacción del cliente: Nuestro objetivo es superar las expectativas de nuestros clientes ofreciendo un servicio amable y atento en un ambiente acogedor.</li>
                </ul>
            </div>
            <div class="info_box">
                <h5>Nuestra Visión</h5>
                <ul>
                    <li><i class="fa fa-check"></i> Ser reconocidos como el mejor restaurante de mariscos en la región.</li>
                    <li><i class="fa fa-check"></i> Expandir nuestras operaciones a nivel nacional e internacional.</li>
                    <li><i class="fa fa-check"></i> Continuar innovando y mejorando nuestra oferta culinaria.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p style="color: white; font-size: 18px; margin-bottom: 20px;">Síguenos en nuestras redes sociales</p>
                    <ul class="sociel">
                        <li><a href="https://www.facebook.com/turing.mx/"><i class="fa fa-facebook-f"></i></a></li>
                        <li><a href="https://x.com/IaTuring"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/turing.ia_/"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/plugin.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/custom.js"></script>
<script>
    $(document).ready(function() {
        // Código para mostrar el menú móvil
        $('.navbar-toggler').click(function() {
            $('#navbarNav').toggle();
        });

        // Cargar productos desde la API
        $.getJSON('obtener_productos.php', function(data) {
            var productosList = $('#productos-list');
            data.slice(0, 3).forEach(function(producto) {
                var productItem = `
                    <div class="col-md-4">
                        <div class="product_box">
                            <div class="product_img">
                                <img src="${producto.imagen}" alt="${producto.nombre}">
                            </div>
                            <div class="product_detail">
                                <h5>${producto.nombre}</h5>
                                <p>${producto.descripcion}</p>
                                <p><strong>Precio: </strong>${producto.precio}</p>
                            </div>
                        </div>
                    </div>
                `;
                productosList.append(productItem);
            });
        });
    });
</script>
</body>
</html>
