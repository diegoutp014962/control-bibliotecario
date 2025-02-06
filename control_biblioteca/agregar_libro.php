<?php
include 'conexion.php'; // Incluir conexión a la base de datos

// Insertar libro en la base de datos
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nombre = trim($_POST['nombre']);
    $autor = trim($_POST['autor']);
    $editorial = trim($_POST['editorial']);
    $folio = trim($_POST['folio']);

    if (!empty($nombre) && !empty($autor) && !empty($editorial) && !empty($folio)) {
        $stmt = $conn->prepare("INSERT INTO libros (nombre, autor, editorial, folio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $autor, $editorial, $folio);
        if ($stmt->execute()) {
            echo "<p style='color: green;'>Libro agregado correctamente.</p>";
        } else {
            echo "<p style='color: red;'>Error al insertar: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p style='color: red;'>Todos los campos son obligatorios.</p>";
    }
}

// Obtener libros de la base de datos
$result = $conn->query("SELECT * FROM libros");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Libros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background: white;
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
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro de Libros</h2>
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre del libro" required>
            <input type="text" name="autor" placeholder="Autor" required>
            <input type="text" name="editorial" placeholder="Editorial" required>
            <input type="text" name="folio" placeholder="Folio" required>
            <button type="submit">Agregar Libro</button>
        </form>

        <h2>Libros Registrados</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>Folio</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['autor']); ?></td>
                <td><?php echo htmlspecialchars($row['editorial']); ?></td>
                <td><?php echo htmlspecialchars($row['folio']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
