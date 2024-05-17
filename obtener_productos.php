<?php
include 'config.php'; 

header('Content-Type: application/json'); 

// Consulta para obtener todos los productos de la base de datos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

$productos = array(); // Inicializar un array para almacenar los productos

// Verificar si la consulta devolvió resultados
if ($result->num_rows > 0) {
    // Recorrer los resultados y agregarlos al array de productos
    while($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
} else {
    error_log("No products found in the database."); 
    echo json_encode(["message" => "No products found"]); 
}

// Verificar si el array de productos está vacío y registrar un mensaje de error si es el caso
if (empty($productos)) {
    error_log("Product array is empty.");
} else {
    error_log("Products found: " . json_encode($productos)); // Registrar los productos encontrados
}

// Enviar la respuesta JSON con los productos
echo json_encode($productos);

$conn->close(); 
?>
