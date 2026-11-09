
<?php
require_once "conexion.php";

try {
    $sql = "SELECT id, nombres, apellidos, correo, carrera, semestre, fecha_creacion
            FROM estudiantes
            ORDER BY id DESC";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    $estudiantes = $stmt->fetchAll();

} catch (PDOException $e) {
    error_log("Error al consultar estudiantes: " . $e->getMessage());
    die("No fue posible cargar los estudiantes. Inténtelo más tarde.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes registrados</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px 15px;
        }

        .contenedor {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            color: #1e3a8a;
        }

        .tabla-contenedor {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            min-width: 850px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background: #1d4ed8;
            color: white;
        }

        tr:hover {
            background: #f8fafc;
        }

        .boton {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 18px;
            background: #1d4ed8;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .sin-registros {
            text-align: center;
            padding: 20px;
            color: #64748b;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>Estudiantes registrados</h1>

    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Carrera</th>
                    <th>Semestre</th>
                    <th>Fecha de creación</th>
                </tr>
            </thead>

            <tbody>
                <?php if (count($estudiantes) > 0): ?>

                    <?php foreach ($estudiantes as $estudiante): ?>
                        <tr>
                            <td><?= htmlspecialchars((string)$estudiante["id"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($estudiante["nombres"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($estudiante["apellidos"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($estudiante["correo"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($estudiante["carrera"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars((string)$estudiante["semestre"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($estudiante["fecha_creacion"], ENT_QUOTES, "UTF-8") ?></td>
                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="7" class="sin-registros">
                            No hay estudiantes registrados.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <a href="index.php" class="boton">Registrar otro estudiante</a>

</div>

</body>
</html>
