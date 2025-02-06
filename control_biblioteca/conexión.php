<?php
$servername = "localhost";  // Servidor de base de datos
$username = "root";         // Usuario (por defecto en XAMPP)
$password = "";             // Contraseña (vacía por defecto en XAMPP)
$database = "prueba1";   // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
