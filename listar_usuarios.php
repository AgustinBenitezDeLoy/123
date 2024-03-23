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

$sql = "SELECT id, nombre, correo, rol FROM usuarios";
$result = $conn->query($sql);

echo "<h2>Listado de Usuarios</h2>";
echo "<table border='1'><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Rol</th><th>Acción</th></tr>";
if ($result->num_rows > 0) {
    // Mostrar resultados de cada fila
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['correo']}</td>
                <td>{$row['rol']}</td>
                <td><a href='eliminar_usuarios.php?id={$row['id']}' onclick='return confirm(\"¿Estás seguro de querer eliminar este usuario?\");'>Eliminar</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No se encontraron usuarios</td></tr>";
}
echo "</table>";

$conn->close();

?>
<a href="gestion_usuarios.php" style="display: inline-block; margin-top: 20px; text-decoration: none; padding: 10px; background-color: #007bff; color: white; border-radius: 5px;">Volver a Gestión de Usuarios</a>