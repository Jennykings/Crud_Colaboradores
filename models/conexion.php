<?php
class Conexion {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "capacitacion";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        $this->conn->set_charset("utf8mb4");
    }
}