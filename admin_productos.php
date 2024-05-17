<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['nombre_usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Incluir el archivo de configuración para la conexión a la base de datos
include 'config.php';

// Obtener mensajes de error y éxito desde la URL, si existen
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
$success = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';

// Obtener todos los productos de la base de datos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
$productos = [];

// Verificar si hay productos y almacenarlos en un array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Productos</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_dashboard.css"> <!-- Reutilizamos el CSS del dashboard -->
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <!-- Encabezado con navegación -->
    <header class="admin-header">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="admin_dashboard.php">Agregar Productos</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <!-- Sección del panel de administración -->
    <section class="admin-dashboard">
        <h1>Productos Existentes</h1>

        <!-- Mostrar mensajes de error o éxito -->
        <?php if ($error): ?>
            <div class="error-message">
                <p><?php echo $error; ?></p>
                <a href="admin_productos.php" class="retry-button">Volver a intentar</a>
                <a href="index.php" class="inicio-button">Ir al Inicio</a>
            </div>
        <?php elseif ($success): ?>
            <div class="success-message">
                <p><?php echo $success; ?></p>
                <a href="admin_productos.php" class="retry-button">Continuar</a>
                <a href="index.php" class="inicio-button">Ir al Inicio</a>
            </div>
        <?php endif; ?>

        <!-- Tabla de productos existentes -->
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mostrar los productos obtenidos de la base de datos -->
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" width="50"></td>
                        <td>
                            <a href="editar_producto.php?id=<?php echo $producto['id']; ?>" class="edit-button">Editar</a>
                            <a href="eliminar_producto.php?id=<?php echo $producto['id']; ?>" class="delete-button" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
