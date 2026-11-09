
<?php
require_once "conexion.php";

$mensaje = "";
$tipo_mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombres = trim($_POST["nombres"] ?? "");
    $apellidos = trim($_POST["apellidos"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $carrera = trim($_POST["carrera"] ?? "");
    $semestre = filter_input(INPUT_POST, "semestre", FILTER_VALIDATE_INT);

    if (
        $nombres === "" ||
        $apellidos === "" ||
        $correo === "" ||
        $carrera === "" ||
        $semestre === false ||
        $semestre === null ||
        $semestre < 1 ||
        $semestre > 12 ||
        !filter_var($correo, FILTER_VALIDATE_EMAIL)
    ) {
        $mensaje = "Verifica los datos ingresados. Todos los campos son obligatorios y el semestre debe estar entre 1 y 12.";
        $tipo_mensaje = "error";
    } else {
        try {
            $sql = "INSERT INTO estudiantes
                    (nombres, apellidos, correo, carrera, semestre)
                    VALUES
                    (:nombres, :apellidos, :correo, :carrera, :semestre)";

            $stmt = $conexion->prepare($sql);

            $stmt->execute([
                ":nombres" => $nombres,
                ":apellidos" => $apellidos,
                ":correo" => $correo,
                ":carrera" => $carrera,
                ":semestre" => $semestre
            ]);

            $mensaje = "Estudiante registrado correctamente.";
            $tipo_mensaje = "exito";

        } catch (PDOException $e) {
            error_log("Error al registrar estudiante: " . $e->getMessage());

            if ($e->getCode() === "23000") {
                $mensaje = "Ese correo electrónico ya está registrado.";
            } else {
                $mensaje = "No fue posible registrar el estudiante. Inténtalo nuevamente.";
            }

            $tipo_mensaje = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estudiantes</title>

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
            max-width: 550px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            color: #1e3a8a;
        }

        p {
            text-align: center;
            color: #64748b;
        }

        label {
            display: block;
            margin-top: 16px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-top: 7px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 15px;
        }

        button {
            width: 100%;
            margin-top: 24px;
            padding: 13px;
            background: #1d4ed8;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #1e40af;
        }

        .mensaje {
            padding: 12px;
            margin-top: 18px;
            border-radius: 6px;
            text-align: center;
        }

        .exito {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .enlace {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #1d4ed8;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>Registro de Estudiantes</h1>
    <p>Ingrese los datos del estudiante</p>

    <?php if ($mensaje !== ""): ?>
        <div class="mensaje <?= htmlspecialchars($tipo_mensaje, ENT_QUOTES, 'UTF-8') ?>">
            <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php">

        <label for="nombres">Nombres:</label>
        <input type="text" id="nombres" name="nombres"
               maxlength="80" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos"
               maxlength="80" required>

        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo"
               maxlength="120" required>

        <label for="carrera">Carrera:</label>
        <input type="text" id="carrera" name="carrera"
               maxlength="100" required>

        <label for="semestre">Semestre:</label>
        <select id="semestre" name="semestre" required>
            <option value="">Seleccione un semestre</option>
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>

        <button type="submit">Registrar estudiante</button>

    </form>

    <a class="enlace" href="estudiantes.php">
        Consultar estudiantes registrados
    </a>

</div>

</body>
</html>
