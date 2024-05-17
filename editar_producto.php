<?php
session_start(); // Iniciar la sesión

include 'config.php'; // Incluir el archivo de configuración de la base de datos

// Verificar si el usuario ha iniciado sesión y tiene el rol de administrador
if (!isset($_SESSION['nombre_usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php"); // Redirigir al usuario a la página de inicio de sesión si no está autorizado
    exit(); // Terminar la ejecución del script
}

// Obtener el ID del producto a editar
$id = $_GET['id'];

// Obtener los mensajes de error y éxito, si existen
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
$success = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';

// Conectar a la base de datos
$conn = new mysqli("localhost", "root", "", "login");

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Mostrar mensaje de error y terminar el script en caso de fallo de conexión
}

// Consultar el producto a editar por su ID
$sql = "SELECT * FROM productos WHERE id = $id";
$result = $conn->query($sql);

// Verificar si el producto existe
if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc(); // Obtener los datos del producto
} else {
    // Redirigir con un mensaje de error si el producto no existe
    $error = "Producto no encontrado.";
    header("Location: admin_dashboard.php?error=" . urlencode($error));
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_dashboard.css"> <!-- Reutilizamos el CSS del dashboard -->
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <header class="admin-header">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="admin_dashboard.php">Productos</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    <section class="admin-dashboard">
        <h1>Editar Producto</h1>
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
        <form id="editarProductoForm" class="product-form" action="actualizar_producto.php" method="post" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            <label for="nombre">Nombre del producto:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required><br><br>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea><br><br>
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" id="precio" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required><br><br>
            <label for="imagen">URL de la imagen:</label>
            <input type="text" id="imagen" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>" required><br><br>
            <input type="submit" value="Actualizar Producto">
        </form>
    </section>

    <script>
        // Función para validar el formulario de edición de producto
        function validateForm() {
            var nombre = document.getElementById("nombre").value;
            var descripcion = document.getElementById("descripcion").value;
            var precio = document.getElementById("precio").value;
            var imagen = document.getElementById("imagen").value;

            if (nombre === "") {
                alert("Por favor, ingrese el nombre del producto.");
                return false;
            }

            if (descripcion === "") {
                alert("Por favor, ingrese la descripción del producto.");
                return false;
            }

            if (precio === "" || isNaN(precio) || parseFloat(precio) <= 0) {
                alert("Por favor, ingrese un precio válido.");
                return false;
            }

            if (imagen === "") {
                alert("Por favor, ingrese la URL de la imagen del producto.");
                return false;
            }

            return true; // Si todas las validaciones son correctas, se permite el envío del formulario
        }
    </script>
</body>
</html>
