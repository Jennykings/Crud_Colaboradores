<?php
session_start();
require_once __DIR__ . "/models/conexion.php";
$db = new Conexion();
$conn = $db->conn;

// Obtener colaboradores
$stmt = $conn->prepare("SELECT id, nombre, cargo, puesto, edad, fecha_ingreso FROM colaboradores ORDER BY id ASC");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Colaboradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script>
</head>
<body class="container mt-4">
    <h2 class="mb-3">Gestión de Colaboradores</h2>

    <!-- Alertas -->
    <?php if (!empty($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo'] ?> alert-dismissible fade show">
            <?= $_SESSION['mensaje'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['mensaje'], $_SESSION['tipo']); ?>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Formulario -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">Agregar colaborador</div>
                <div class="card-body">
                    <form action="controladores/registrar_colaborador.php" method="POST" novalidate>
                        <div class="mb-2">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Cargo</label>
                            <input type="text" name="cargo" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Puesto</label>
                            <select name="puesto" class="form-select" required>
                                <option value="Diseño Web">Diseño Web</option>
                                <option value="Diseño Gráfico">Diseño Gráfico</option>
                                <option value="Community Manager">Community Manager</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Edad</label>
                            <input type="number" name="edad" min="0" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha de ingreso</label>
                            <input type="date" name="fecha_ingreso" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Agregar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabla -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">Lista de colaboradores</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Cargo</th>
                                    <th>Puesto</th>
                                    <th>Edad</th>
                                    <th>Ingreso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= (int)$row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                    <td><?= htmlspecialchars($row['cargo']) ?></td>
                                    <td><?= htmlspecialchars($row['puesto']) ?></td>
                                    <td><?= (int)$row['edad'] ?></td>
                                    <td><?= date("d/m/Y", strtotime($row['fecha_ingreso'])) ?></td>
                                    <td class="text-nowrap">
                                        <a href="edit.php?id=<?= (int)$row['id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                        <a href="controladores/eliminar_colaborador.php?id=<?= (int)$row['id'] ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Seguro que deseas eliminarlo?')"><i class="fa-solid fa-trash"></i> Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; $stmt->close(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
