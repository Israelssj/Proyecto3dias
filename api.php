<?php
// Establecer el tipo de contenido de la respuesta a JSON
header("Content-Type: application/json");

// Incluir el archivo de configuración para la conexión a la base de datos
include 'config.php';

// Obtener el método de solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Manejar la solicitud según el método HTTP
switch($method) {
    case 'GET':
        // Si se proporciona un ID, obtener un solo producto
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM productos WHERE id = $id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            // Obtener todos los productos
            $sql = "SELECT * FROM productos";
            $result = $conn->query($sql);
            $rows = array();
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            echo json_encode($rows);
        }
        break;
    case 'POST':
        // Crear un nuevo producto
        $data = json_decode(file_get_contents('php://input'), true);
        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $precio = $data['precio'];
        $imagen = $data['imagen'];
        $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES ('$nombre', '$descripcion', $precio, '$imagen')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["mensaje" => "Producto creado exitosamente"]);
        } else {
            echo json_encode(["mensaje" => "Error: " . $sql . "<br>" . $conn->error]);
        }
        break;
    case 'PUT':
        // Actualizar un producto existente
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $precio = $data['precio'];
        $imagen = $data['imagen'];
        $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio=$precio, imagen='$imagen' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["mensaje" => "Producto actualizado exitosamente"]);
        } else {
            echo json_encode(["mensaje" => "Error: " . $sql . "<br>" . $conn->error]);
        }
        break;
    case 'DELETE':
        // Eliminar un producto
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM productos WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["mensaje" => "Producto eliminado exitosamente"]);
            } else {
                echo json_encode(["mensaje" => "Error: " . $sql . "<br>" . $conn->error]);
            }
        }
        break;
    default:
        // Manejar métodos no soportados
        echo json_encode(["mensaje" => "Método no soportado"]);
        break;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
