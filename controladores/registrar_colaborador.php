<?php
session_start();
require_once __DIR__ . "/../models/conexion.php";
$db = new Conexion();
$conn = $db->conn;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST['nombre'] ?? "");
    $cargo  = trim($_POST['cargo'] ?? "");
    $puesto = $_POST['puesto'] ?? "";
    $edad   = (int)($_POST['edad'] ?? 0);
    $fecha  = $_POST['fecha_ingreso'] ?? "";

    // Validación de campos
    if ($nombre === "" || $cargo === "" || $puesto === "" || $edad <= 0 || $fecha === "") {
        $_SESSION['mensaje'] = "Todos los campos son obligatorios y deben ser válidos.";
        $_SESSION['tipo'] = "danger";
        header("Location: ../index.php");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO colaboradores (nombre, cargo, puesto, edad, fecha_ingreso) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $nombre, $cargo, $puesto, $edad, $fecha);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Colaborador agregado correctamente.";
        $_SESSION['tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al agregar colaborador.";
        $_SESSION['tipo'] = "danger";
    }
    header("Location: ../index.php");
    exit;
}
