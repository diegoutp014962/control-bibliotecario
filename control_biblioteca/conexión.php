<?php
$host = 'localhost'; // Cambia según tu configuración
$db = 'biblioteca_digital';
$user = 'root'; // Reemplaza con el nombre de usuario que creaste
$pass = ''; // Reemplaza con la contraseña que creaste

// Conectar a la base de datos
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos '$db'";
}

$conn->close();
?>
