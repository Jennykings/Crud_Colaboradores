<?php
require_once __DIR__ . "/models/conexion.php";
$db = new Conexion();
$conn = $db->conn;

if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = (int)$_GET['id'];

// Obtener colaborador
$stmt = $conn->prepare("SELECT id, nombre, cargo, puesto, edad, fecha_ingreso FROM colaboradores WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$colaborador = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$colaborador) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Colaborador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="mb-3">Editar colaborador</h2>

    <form action="controladores/modificar_colaborador.php" method="POST" class="border p-3 rounded bg-light">
        <input type="hidden" name="id" value="<?= (int)$colaborador['id'] ?>">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($colaborador['nombre']) ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Cargo</label>
                <input type="text" name="cargo" class="form-control" value="<?= htmlspecialchars($colaborador['cargo']) ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Puesto</label>
                <select name="puesto" class="form-select" required>
                    <option value="Diseño Web" <?= $colaborador['puesto'] === "Diseño Web" ? "selected" : "" ?>>Diseño Web</option>
                    <option value="Diseño Gráfico" <?= $colaborador['puesto'] === "Diseño Gráfico" ? "selected" : "" ?>>Diseño Gráfico</option>
                    <option value="Community Manager" <?= $colaborador['puesto'] === "Community Manager" ? "selected" : "" ?>>Community Manager</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Edad</label>
                <input type="number" name="edad" min="0" class="form-control" value="<?= (int)$colaborador['edad'] ?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Fecha de ingreso</label>
                <input type="date" name="fecha_ingreso" class="form-control" value="<?= htmlspecialchars($colaborador['fecha_ingreso']) ?>" required>
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-warning">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</body>
</html>
