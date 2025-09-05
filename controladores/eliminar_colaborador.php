<?php
session_start();
require_once __DIR__ . "/../models/conexion.php";
$db = new Conexion();
$conn = $db->conn;

if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = $conn->prepare("DELETE FROM colaboradores WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Colaborador eliminado correctamente.";
        $_SESSION['tipo'] = "danger";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar colaborador.";
        $_SESSION['tipo'] = "danger";
    }
}
header("Location: ../index.php");
exit;
