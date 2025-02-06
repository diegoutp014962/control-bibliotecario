<?php
session_start();

// Inicializar lista de libros y préstamos
if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = [];
}
if (!isset($_SESSION['prestamos'])) {
    $_SESSION['prestamos'] = [];
}

// Prestar libro
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['prestar_libro'])) {
    $libro = trim($_POST['libro_seleccionado']);
    $persona = trim($_POST['persona']);
    $documento = trim($_POST['documento']);
    if (!empty($libro) && !empty($persona) && in_array($libro, $_SESSION['libros'])) {
        $fecha_prestamo = date("Y-m-d");
        $fecha_entrega = date("Y-m-d", strtotime("+15 days"));
        $_SESSION['prestamos'][] = ["libro" => $libro, "persona" => $persona, "fecha_prestamo" => $fecha_prestamo, "fecha_entrega" => $fecha_entrega, "documento" => $documento];
        $_SESSION['libros'] = array_diff($_SESSION['libros'], [$libro]);
    }
}

// Devolver libro
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['devolver_libro'])) {
    $libro = trim($_POST['libro_devuelto']);
    $persona = trim($_POST['persona_devuelve']);
    foreach ($_SESSION['prestamos'] as $key => $prestamo) {
        if ($prestamo['libro'] == $libro && $prestamo['persona'] == $persona) {
            $_SESSION['libros'][] = $libro;
            unset($_SESSION['prestamos'][$key]);
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Bibliotecario</title>
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
        h1 {
            color:rgb(102, 0, 0);
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        h2 {
            color:rgb(104, 0, 0);
            margin-bottom: 10px;
        }
        form {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            border-radius: 12px;
        }
        input, select, button {
            width: 95%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color:rgb(102, 0, 0);
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color:rgb(102, 0, 0);
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            border-radius: 12px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            color: black; /* Ajustar color para buena visibilidad */
        }
        th {
            background-color:rgb(102, 0, 0);
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background: rgba(255, 255, 255, 0.8);
            margin: 10px 0;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            color: black;
        }
        .button-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color:rgb(102, 0, 0);
            color: white;
            width: 50px;
            height: 50px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }
        .button-float:hover {
            background-color:rgb(102, 0, 0);
        }
    </style>
</head>
<body>
    <h1>Control Bibliotecario</h1>
    
    <h2>Prestar Libro</h2>
    <form method="POST">
        <select name="libro_seleccionado" required>
            <?php foreach ($_SESSION['libros'] as $libro) { echo "<option value='$libro'>$libro</option>"; } ?>
        </select>
        <input type="text" name="persona" placeholder="Nombre de la persona" required>
        <input type="text" name="documento" placeholder="Documento en garantía" required>
        <button type="submit" name="prestar_libro">Prestar</button>
    </form>
    
    <h2>Devolver Libro</h2>
    <form method="POST">
        <input type="text" name="libro_devuelto" placeholder="Nombre del libro" required>
        <input type="text" name="persona_devuelve" placeholder="Nombre de la persona" required>
        <button type="submit" name="devolver_libro">Devolver</button>
    </form>

    
    <h2>Libros Prestados</h2>
    <table>
        <tr>
            <th>Libro</th>
            <th>Persona</th>
            <th>Fecha de Préstamo</th>
            <th>Fecha de Entrega</th>
            <th>Documento</th>
        </tr>
        <?php foreach ($_SESSION['prestamos'] as $prestamo) {
            echo "<tr><td>{$prestamo['libro']}</td><td>{$prestamo['persona']}</td><td>{$prestamo['fecha_prestamo']}</td><td>{$prestamo['fecha_entrega']}</td><td>{$prestamo['documento']}</td></tr>";
        } ?>
    </table>
    
    <button class="button-float" onclick="window.location.href='agregar_libro.php'">+</button>
</body>
</html>
