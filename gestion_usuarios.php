<?php
// Conexión a la base de datos
$host = 'localhost';
$database = 'reentraste'; // Reemplaza con el nombre de tu base de datos
$username = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña del usuario de la base de datos

$conn = new mysqli($host, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar mensaje de error como una cadena vacía
$errorMessage = "";

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que los campos no estén vacíos
    if (!empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['rol'])) {
        // Preparar consulta SQL para insertar el nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, rol) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $_POST['nombre'], $_POST['correo'], $_POST['rol']);

        // Ejecutar y verificar el éxito de la consulta
        if ($stmt->execute()) {
            echo "Nuevo usuario agregado con éxito.";
        } else {
            echo "Error al agregar el usuario: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Asignar mensaje de error
        $errorMessage = "Por favor, completa todos los campos del formulario.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
</head>
<body>
    <h2>Agregar Usuario</h2>
    <?php
    // Mostrar mensaje de error si existe
    if (!empty($errorMessage)) {
        echo "<p style='color:red;'>$errorMessage</p>";
    }
    ?>
    <form action="gestion_usuarios.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        
        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" required><br>
        
        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required>
            <option value="usuario">Usuario</option>
            <option value="administrador">Administrador</option>
        </select><br>
        
        <button type="submit">Agregar Usuario</button>
<a href="listar_usuarios.php" style="display: inline-block; margin-top: 10px; text-decoration: none; padding: 10px; background-color: #007bff; color: white; border-radius: 5px;">Listar Usuarios</a>
        
<a href="panel_admin.php" style="display: inline-block; margin-top: 20px; text-decoration: none; padding: 10px; background-color: #007bff; color: white; border-radius: 5px;">Atrás</a>

    </form>
</body>
</html>
