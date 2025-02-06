<?php
session_start();

// Inicializar lista de libros
if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = [];
}

// Agregar libro
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['agregar_libro'])) {
    $libro = trim($_POST['libro']);
    if (!empty($libro)) {
        $_SESSION['libros'][] = $libro;
    }
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Libro</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('imagenes/img01.jpg'); /* Reemplaza con el nombre correcto */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 20px;
            text-align: center;
            color: white; /* Cambiar color del texto para mayor visibilidad */
        }
        .btn-atras {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 50px;
            height: 50px;
            background-color: rgb(102, 0, 0);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            z-index: 1; /* Asegurar que el botón esté en frente */
        }
        form.main-form {
            background: white;
            padding: 20px;
            margin: 20px auto;
            width: 50%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        input, button {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: rgb(102, 0, 0);
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: rgb(102, 0, 0);
        }
    </style>
</head>
<body>
    <form method="get" action="index.php">
        <button class="btn-atras" type="submit">←</button>
    </form>
    <h1>Agregar Libro</h1>
    <form method="POST" class="main-form">
        <input type="text" name="libro" placeholder="Nombre del libro" required>
        <button type="submit" name="agregar_libro">Agregar</button>
    </form>
</body>
</html>
