<?php
class TareaModel {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function obtenerTodas() {
    $sql = "SELECT * FROM tareas";
    return $this->conn->query($sql);
  }

  public function obtenerPorId($id) {
    $sql = "SELECT * FROM tareas WHERE id=?";
    $sentencia = $this->conn->prepare($sql);
    $sentencia->execute([$id]);
    return $sentencia->fetch(PDO::FETCH_LAZY);
  }

  public function agregar($tarea, $descripcion) {
    $sql = 'INSERT INTO tareas (tarea, descripcion) VALUES(?, ?)';
    $sentencia = $this->conn->prepare($sql);
    $sentencia->execute([$tarea, $descripcion]);
  }

  public function editar($id, $tarea, $descripcion) {
    $sql = "UPDATE tareas SET tarea=?, descripcion=? WHERE id=?";
    $sentencia = $this->conn->prepare($sql);
    $sentencia->execute([$tarea, $descripcion, $id]);
  }

  public function actualizarCompletado($id, $completado) {
    $sql = "UPDATE tareas SET completado=? WHERE id=?";
    $sentencia = $this->conn->prepare($sql);
    $sentencia->execute([$completado, $id]);
  }

  public function eliminar($id) {
    $sql = "DELETE FROM tareas WHERE id = ?";
    $sentencia = $this->conn->prepare($sql);
    $sentencia->execute([$id]);
  }
}