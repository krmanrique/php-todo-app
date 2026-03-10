<?php
function getConnection() {
    try {
        $conn = new PDO('sqlsrv:server=localhost;Database=aplicacion', '', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}