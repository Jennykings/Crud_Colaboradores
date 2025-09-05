<?php
session_start();
require_once __DIR__ . "/../models/conexion.php";
$db = new Conexion();
$conn = $db->conn;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['id']) || !ctype_digit($_POST['id'])) {
        header("Location: ../index.php");
        exit;
    }

    $id     = (int)$_POST['id'];
    $nombre = trim($_POST['nombre'] ?? "");
    $cargo  = trim($_POST['cargo'] ?? "");
    $puesto = $_POST['puesto'] ?? "";
    $edad   = (int)($_POST['edad'] ?? 0);
    $fecha  = $_POST['fecha_ingreso'] ?? "";

    // Validación de campos obligatorios
    if ($nombre === "" || $cargo === "" || $puesto === "" || $edad <= 0 || $fecha === "") {
        $_SESSION['mensaje'] = "Todos los campos son obligatorios y deben contener valores válidos.";
        $_SESSION['tipo'] = "danger";
        header("Location: ../index.php");
        exit;
    }

    $stmt = $conn->prepare("UPDATE colaboradores SET nombre = ?, cargo = ?, puesto = ?, edad = ?, fecha_ingreso = ? WHERE id = ?");
    $stmt->bind_param("sssisi", $nombre, $cargo, $puesto, $edad, $fecha, $id);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Colaborador modificado correctamente.";
        $_SESSION['tipo'] = "warning";
    } else {
        $_SESSION['mensaje'] = "Error al modificar colaborador.";
        $_SESSION['tipo'] = "danger";
    }
    header("Location: ../index.php");
    exit;
}
