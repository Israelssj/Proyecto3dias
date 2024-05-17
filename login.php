<?php
session_start(); // Iniciar la sesión del usuario
include 'config.php'; // Incluir archivo de configuración para la conexión a la base de datos

$error = '';

// Procesar el formulario solo si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario']; 
    $contrasena = md5($_POST['contrasena']); 
    
    // Consulta para verificar el nombre de usuario y la contraseña
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre_usuario, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        $_SESSION['rol'] = $row['rol'];

        // Redirigir al usuario según su rol
        if ($row['rol'] == 'admin') {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            header("Location: usuario_dashboard.php");
            exit();
        }
    } else {
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <style>
        body {
            background-color: #CED8E1;
            font-family: 'Poppins', sans-serif;
            color: #102B3E;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .login-container {
            background-color: #102B3E;
            color: #CED8E1;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 300px;
        }
        
        .login-container h2 {
            margin-bottom: 20px;
        }
        
        .login-form {
            display: flex;
            flex-direction: column;
        }
        
        .login-form label {
            margin-bottom: 5px;
            text-align: left;
        }
        
        .login-form input[type="text"],
        .login-form input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 4px;
        }
        
        .login-form input[type="submit"] {
            background-color: #1CC8A0;
            color: #102B3E;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .login-form input[type="submit"]:hover {
            background-color: #16A085;
        }
        
        .inicio-button,
        .retry-button {
            display: block;
            margin-top: 20px;
            background-color: #1CC8A0;
            color: #102B3E;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }
        
        .inicio-button:hover,
        .retry-button:hover {
            background-color: #16A085;
        }
        
        .error-message {
            background-color: #FF6347;
            color: white;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            .login-container {
                width: 90%;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <!-- Mostrar mensaje de error si existe -->
        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <!-- Formulario de inicio de sesión -->
        <form action="login.php" method="post" class="login-form">
            <label for="nombre_usuario">Nombre de usuario:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
            <input type="submit" value="Ingresar">
        </form>
        <a href="index.php" class="inicio-button">Ir al Inicio</a>
    </div>
</body>
</html>
