<?php
session_start(); // Iniciar la sesión

include 'config.php'; // Incluir el archivo de configuración de la base de datos

// Verificar si la solicitud es de tipo GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id']; // Obtener el ID del producto a eliminar

    // Preparar la consulta SQL para eliminar el producto
    $sql = "DELETE FROM productos WHERE id = $id";
    
    // Ejecutar la consulta SQL y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php?success=Producto eliminado exitosamente."); // Redirigir con mensaje de éxito
    } else {
        // Si hay un error, redirigir con mensaje de error
        $error = "Error al eliminar producto: " . $conn->error;
        header("Location: admin_dashboard.php?error=" . urlencode($error));
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si el método de solicitud no es GET, redirigir con mensaje de error
    $error = "Método no soportado";
    header("Location: admin_dashboard.php?error=" . urlencode($error));
    exit(); // Terminar la ejecución del script
}
?>
