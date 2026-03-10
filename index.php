<?php include("agregarTarea.PHP"); ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Aplicación TODO list</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />

    <style>
      .subrayado{ text-decoration:line-through; }
    </style>
  </head>

  <body>
    <header>
      <!-- place navbar here -->
    </header>
    <main class="container">
    <br/>
    <div class="card">
      <div class="card-header">
        Lista de tareas (TODO LIST)
      </div>
      <div class="card-body">


        <?php
        $modoEditar = false;

        if(isset($_GET['editar'])){
          $modoEditar = true;

          $id = $_GET['editar'];

          $sql="SELECT * FROM tareas WHERE id=?";
          $sentencia = $conn->prepare($sql);
          $sentencia->execute([$id]);
          $tareaEditar=$sentencia->fetch(PDO::FETCH_LAZY);
        }
        ?>

<!-- escribir tarea -->

        <div class="mb-3">
          <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $modoEditar ? $tareaEditar['id'] : ''; ?>">
            <label for="tarea" class="form-label">Tarea:</label>
            <input
              type="text"
              class="form-control"
              name="tarea"
              value="<?php echo $modoEditar ? $tareaEditar['tarea'] : ''; ?>"
              id="tarea"
              aria-describedby="helpId"
              placeholder="Escriba su tarea"
            />

            <br/>
            
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea
              class="form-control"
              name="descripcion"
              placeholder="Escriba la descripción"
            ><?php echo $modoEditar ? $tareaEditar['descripcion'] : ''; ?></textarea>

            <br/>
            

            <?php if($modoEditar){ ?>

            <input
            name="editar_tarea"
            class="btn btn-warning"
            type="submit"
            value="Editar tarea"
            />

            <?php } else { ?>

            <input
            name="agregar_tarea"
            class="btn btn-primary"
            type="submit"
            value="Agregar tarea"
            />

            <?php } ?>

          </form>
        </div>
          
        <ul class="list-group">

        <?php foreach($registros as $registro) { ?>
          
        <li class="list-group-item d-flex">

        <form action="" method="post">
          <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">
          <input
            class="form-check-input float-start"
            type="checkbox"
            name="completado"
            value="<?php echo $registro['completado']; ?>"
            id=""
            onchange="this.form.submit()"
            <?php echo ($registro['completado']==1)?'checked':''; ?>
          />

        </form>

                <!-- completado o no -->
          &nbsp; 
          <span 
          class="float-start <?php echo ($registro['completado']==1)?'subrayado':''; ?> "> 
          &nbsp; <strong><?php echo $registro['tarea']; ?></strong>

          <br>

          <small class="text-muted">
          &nbsp; <?php echo $registro['descripcion']; ?>
          </small>
          </span> 

          <h6 class="float-start">
            &nbsp; <a href="?id=<?php echo $registro['id']; ?>"><span class="badge bg-danger"> X </span></a>
            &nbsp; <a href="?editar=<?php echo $registro['id']; ?>"><span class="badge bg-warning"> Editar </span></a>
          </h6>
        </li>
        
        <?php } ?>
          

        </ul>
        
        

      </div>
      <div class="card-footer text-muted"></div>
    </div>
    

    </main>
    <footer>
      <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
