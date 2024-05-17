<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['nombre_usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];

    // Validación básica de los campos
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($imagen)) {
        header("Location: admin_dashboard.php?error=Todos los campos son obligatorios.");
        exit();
    }

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "login");

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar y enlazar la consulta
    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $nombre, $descripcion, $precio, $imagen); // 'd' para el tipo de dato double

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?success=Producto agregado exitosamente.");
    } else {
        header("Location: admin_dashboard.php?error=Error al agregar el producto.");
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
