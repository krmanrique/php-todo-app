<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/TareaModel.php';

$conn = getConnection();
$model = new TareaModel($conn);

if(isset($_POST['id'])) {
  $id = $_POST['id'];
  $completado = (isset($_POST['completado'])) ? 1 : 0;
  $model->actualizarCompletado($id, $completado);
}

if(isset($_POST['editar_tarea'])) {
  $tarea = $_POST['tarea'];
  $descripcion = $_POST['descripcion'];
  $model->editar($id, $tarea, $descripcion);
  header("Location: index.php");
  exit();
}

if(isset($_POST['agregar_tarea'])) {
  $tarea = $_POST['tarea'];
  $descripcion = $_POST['descripcion'];
  $model->agregar($tarea, $descripcion);
  header("Location: index.php");
  exit();
}

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $model->eliminar($id);
}