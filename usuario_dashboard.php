<?php
session_start();

// Verifica si el usuario está logueado y tiene el rol de 'usuario'
if (!isset($_SESSION['nombre_usuario']) || $_SESSION['rol'] != 'usuario') {
    // Si no está logueado o no tiene el rol correcto, redirige al login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/usuario_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .usuario-header nav ul {
            list-style: none;
            display: flex;
            justify-content: space-between;
            padding: 0;
        }
        .usuario-header nav ul li {
            display: inline;
            margin-right: 20px;
        }
        .usuario-header nav ul li a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }
        .usuario-header {
            background-color: #f8f9fa;
            padding: 10px 0;
        }
        .usuario-dashboard {
            padding: 20px;
        }
        .productos-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .producto {
            background-color: #102B3E;
            color: white;
            padding: 20px;
            border-radius: 8px;
            width: 300px; /* Fija el ancho de las cards */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .producto img {
            width: 100%;
            border-radius: 8px;
            height: 200px;
            object-fit: cover;
        }
        .producto h5 {
            margin: 10px 0;
            color: white; 
        }
    </style>
</head>
<body>
    <header class="usuario-header">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    <section class="usuario-dashboard">
        <h1>Productos</h1>
        <div id="productos-container" class="productos-container"></div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Función para obtener productos desde la API
            function obtenerProductos() {
                fetch("http://localhost/Proyecto3dias/api.php")
                    .then(response => response.json())
                    .then(data => {
                        const productosContainer = document.getElementById("productos-container");
                        productosContainer.innerHTML = ""; 
                        data.forEach(producto => {
                            const productoDiv = document.createElement("div");
                            productoDiv.classList.add("producto");
                            productoDiv.innerHTML = `
                                <div class="product_box">
                                    <div class="product_img">
                                        <img src="${producto.imagen}" alt="">
                                    </div>
                                    <div class="product_detail">
                                        <h5>${producto.nombre}</h5>
                                        <p>${producto.descripcion}</p>
                                        <p>Precio: $${producto.precio}</p>
                                    </div>
                                </div>
                            `;
                            productosContainer.appendChild(productoDiv);
                        });
                    })
                    .catch(error => {
                        console.error("Error al obtener los productos:", error);
                    });
            }

            // Llama a la función para obtener productos cuando la página esté lista
            obtenerProductos();
        });
    </script>
</body>
</html>
