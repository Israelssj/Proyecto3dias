<?php

session_start();

// Inicializa variables para verificar si el usuario está logueado y su rol
$usuarioLogueado = false;
$rol = '';

// Verifica si el usuario está logueado y establece las variables adecuadas
if (isset($_SESSION['nombre_usuario'])) {
    $usuarioLogueado = true;
    $rol = $_SESSION['rol'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .btn-sesion {
            background-color: #1CC8A0;
            color: white;
            border: none;
            padding: 7px 20px;
            border-radius: 5px;
        }
        .btn-sesion:hover {
            background-color: #FFC221;
        }
        .dropdown-menu {
            left: -50px;
        }
        .product_detail h5 {
            color: white;
        }
        .product_box {
            background-color: #102B3E;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .product_img img {
            width: 100%;
            border-radius: 8px;
            height: 200px;
            object-fit: cover;
        }
        .product_row {
            margin-bottom: 20px;
        }
        .product_row > div {
            margin-bottom: 20px;
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
                <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#productos">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#ubicacion">Ubicación</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#acerca-de">Acerca de</a></li>
            </ul>
            <?php if ($usuarioLogueado): ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-sesion dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['nombre_usuario']; ?>
                    </button>
                    <div class="dropdown-menu">
                        <?php if ($rol == 'admin'): ?>
                            <a class="dropdown-item" href="admin_dashboard.php">Admin Dashboard</a>
                        <?php elseif ($rol == 'usuario'): ?>
                            <a class="dropdown-item" href="usuario_dashboard.php">Usuario Dashboard</a>
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

<section class="product_section layout_padding" style="background-color: #CED8E1;">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Todos los Productos</h2>
        </div>
        <div class="row product_row" id="productos-list">
            <!-- Productos serán cargados aquí por JavaScript -->
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
                        <li><a href="https://www.facebook.com/turing.mx/"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://x.com/IaTuring"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/turing.ia_/"><i class="fab fa-instagram"></i></a></li>
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
<script>
    $(document).ready(function() {
        // Código para mostrar el menú móvil
        $('.navbar-toggler').click(function() {
            $('#navbarNav').toggle();
        });

        // Cargar productos desde la API
        $.getJSON('obtener_productos.php', function(data) {
            var productosList = $('#productos-list');
            data.forEach(function(producto) {
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
