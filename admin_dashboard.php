<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['nombre_usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Obtener mensajes de error y éxito desde la URL, si existen
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
$success = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_dashboard.css"> 
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <!-- Encabezado con navegación -->
    <header class="admin-header">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="admin_productos.php">Productos</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <!-- Sección del panel de administración -->
    <section class="admin-dashboard">
        <h1>Agregar Productos</h1>
        <!-- Mostrar mensajes de error o éxito -->
        <?php if ($error): ?>
            <div class="error-message">
                <p><?php echo $error; ?></p>
                <a href="admin_dashboard.php" class="retry-button">Volver a intentar</a>
                <a href="index.php" class="inicio-button">Ir al Inicio</a>
            </div>
        <?php elseif ($success): ?>
            <div class="success-message">
                <p><?php echo $success; ?></p>
                <a href="admin_dashboard.php" class="retry-button">Continuar</a>
                <a href="index.php" class="inicio-button">Ir al Inicio</a>
            </div>
        <?php endif; ?>

        <!-- Formulario para agregar un nuevo producto -->
        <form id="agregarProductoForm" class="product-form" action="agregar_producto.php" method="post" onsubmit="return validateForm()">
            <label for="nombre">Nombre del producto:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea><br><br>

            <label for="precio">Precio:</label>
            <input type="number" step="0.01" id="precio" name="precio" required><br><br>

            <label for="imagen">URL de la imagen:</label>
            <input type="text" id="imagen" name="imagen" required><br><br>

            <input type="submit" value="Agregar Producto">
        </form>
    </section>

    <script>
        // Función para validar el formulario antes de enviarlo
        function validateForm() {
            var nombre = document.getElementById("nombre").value;
            var descripcion = document.getElementById("descripcion").value;
            var precio = document.getElementById("precio").value;
            var imagen = document.getElementById("imagen").value;

            // Validar que todos los campos estén completos
            if (nombre === "") {
                alert("Por favor, ingrese el nombre del producto.");
                return false;
            }

            if (descripcion === "") {
                alert("Por favor, ingrese la descripción del producto.");
                return false;
            }

            if (precio === "") {
                alert("Por favor, ingrese el precio del producto.");
                return false;
            }

            if (imagen === "") {
                alert("Por favor, ingrese la URL de la imagen del producto.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
