<?php
  // Verificamos si el formulario fue enviado con el botón 'registrar'
  if(isset($_POST["registrar"])){
    // Escapamos los valores para prevenir ataques XSS
    $nombre = htmlspecialchars($_POST['nombre']);             // Nombre del equipo
    $marca = htmlspecialchars($_POST['marca']);               // Marca del equipo
    $modelo = htmlspecialchars($_POST['modelo']);             // Modelo del equipo
    $descripcion = htmlspecialchars($_POST['descripcion']);   // Descripción del equipo
    $fecha = date('Y-m-d\TH:i:sP');                           // Aignamos la fecha y hora actual a la hora de registrar
    
    // Almacenamos los datos en una array, el primer dato es NULL porque no lo registramos nosotros
    // Convertimos el nombre y la contraseña en minuscula,para evitar problemas
    $datos = [Null, ucfirst(strtolower($nombre)), ucfirst(strtolower($marca)), ucfirst(strtolower($modelo)), ucfirst(strtolower($descripcion)), $fecha];
    // Convertimos la array en un formato compatible con SQL
    $valores = "'" . implode("','", $datos) . "'";

    // Almacenamos los nombres de las columnas de la tabla, separados por comas
    $campos = "Id, Nombre, Marca, Modelo, Descripcion, Fecha_creacion";
    
    $insertar = new IMEC(); // Creamos una instancia de la clase IMEC
    // Llamamos al método Insertar para crear el registro correspondiente
    // Parámetros: tabla ('equipos'), columnas ($campos), valores ($valores), condición (null porque no aplica)
    $insertar->Insertar('equipos', $campos, $valores, null);

    // Mostramos la alerta de éxito
    echo "
      <script>
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'El equipo \"$nombre\" ha sido registrado exitosamente.',
          showConfirmButton: false,
          timer: 1500
        }).then(() => {
          window.location.href = 'equipos.php'; // Redirigimos después de la alerta
        });
      </script>
    ";
    exit; // Detenemos la ejecución para evitar problema
  }
?>

<!-- Modal -->
<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Equipo</h5>
        <!-- Boton para cerrar el modal -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Formulario para ingresar los datos de creación -->
        <form action="equipos.php" method="POST" enctype="multipart/form-data">
          <!-- Campo para ingresar el nombre del equipo -->
          <label>Nombre</label>
          <input type="text" name="nombre" class="form-control" placeholder="Digite el nombre del equipo" required/>
          <br>
          <!-- Campo para ingresar la marca del equipo -->
          <label>Marca</label>
          <input type="text" name="marca" class="form-control" placeholder="Digite la marca" required/>
          <br>
          <!-- Campo para ingresar el modelo del equipo -->
          <label>Modelo</label>
          <input type="text" name="modelo" class="form-control" placeholder="Digite el modelo" required/>
          <br>
          <!-- Campo para ingresar la descripcion del equipo -->
          <label>Descripcion</label>
          <input type="text" name="descripcion" class="form-control" required/>
          <br>
          <!-- Botón para enviar el formulario -->
          <button type="submit" name="registrar" class="btn btn-success">Registrar</button>
        </form>
      </div>
      <div class="modal-footer">
        <!-- Botón para cerrar el formulario -->
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>