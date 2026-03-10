<?php

try {
$conn = new PDO('sqlsrv:server=localhost;Database=aplicacion','','');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Conectado a SQLServer";
} catch (PDOException $e) {
  echo "Error de conexión:" . $e->getMessage();
}

if(isset($_POST['id'])) {
  $id = $_POST['id'];
  $completado = (isset($_POST['completado']))?1:0;

  $sql = "UPDATE tareas SET completado=? WHERE id=?";
  $sentencia = $conn -> prepare($sql);
  $sentencia -> execute([$completado, $id]);
  
  }

  if(isset($_POST['editar_tarea'])) {
    $tarea = ($_POST['tarea']);
    $descripcion = ($_POST['descripcion']);
  
    $sql = "UPDATE tareas SET tarea=?, descripcion=? WHERE id=?";
    $sentencia = $conn -> prepare($sql);
    $sentencia -> execute([$tarea, $descripcion, $id]);
    header("Location: index.php");
    exit();
  }

if(isset($_POST['agregar_tarea'])) {
  $tarea = ($_POST['tarea']);
  $descripcion = ($_POST['descripcion']);
  $sql = 'INSERT INTO tareas (tarea, descripcion) VALUES(?, ?)';
  $sentencia = $conn -> prepare($sql);
  $sentencia -> execute([$tarea, $descripcion]);
  header("Location: index.php");
  exit();
}


if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM tareas WHERE id = ?";
  $sentencia = $conn -> prepare($sql);
  $sentencia -> execute([$id]);
}

$sql = "SELECT * FROM tareas";
$registros= $conn -> query($sql);




?>