<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de configuración para la conexión a la base de datos
include 'config.php';

// Verificar si la solicitud se realiza mediante el método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];

    // Validar que todos los campos estén completos
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($imagen)) {
        $error = "Todos los campos son obligatorios.";
        header("Location: editar_producto.php?id=$id&error=" . urlencode($error));
        exit();
    }

    // Actualizar el producto en la base de datos
    $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', imagen='$imagen' WHERE id=$id";
    
    // Verificar si la actualización fue exitosa
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php?success=Producto actualizado exitosamente.");
    } else {
        // En caso de error, redirigir con el mensaje de error
        $error = "Error al actualizar producto: " . $conn->error;
        header("Location: editar_producto.php?id=$id&error=" . urlencode($error));
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si el método no es POST, redirigir con un mensaje de error
    $error = "Método no soportado";
    header("Location: editar_producto.php?id=$id&error=" . urlencode($error));
    exit();
}
?>
