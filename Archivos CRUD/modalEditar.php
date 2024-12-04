<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<?php
// Verificar si se solicita la edición al dar click en editar
if (isset($_GET["editar"])) {
    $busqueda = new IMEC(); // Creamos una instancia de la clase IMEC
    $codigo = htmlspecialchars($_GET["codigo"]); // Escapamos el valor para prevenir ataques XSS
    $resultado = $busqueda->ConLista('equipos', "Id = '$codigo'");  // Llamamos el método ConLista para buscar la información con el Id ingresado
    $row = $resultado->fetch_assoc();   // Almacenamos los datos buscados

    if ($row) {
        echo "
            <script>
                $(document).ready(function(){
                    $('#modalEditar').modal('show');
                });
            </script>
        ";
    } else {
        echo "<script>alert('Registro no encontrado');</script>";
    }
}

// Procesar la solicitud de actualización
if (isset($_POST['editar'])) {
    // Capturar los datos enviados desde el formulario, escapamos los valores para prevenir ataques XSS
    $codigo = ucfirst(strtolower(htmlspecialchars($_POST['codigo'])));                 // Código del equipo (hidden)
    $nombre = ucfirst(strtolower(htmlspecialchars($_POST['nombre'])));                 // Nombre del equipo
    $marca = ucfirst(strtolower(htmlspecialchars($_POST['marca'])));                   // Marca del equipo
    $modelo = ucfirst(strtolower(htmlspecialchars($_POST['modelo'])));                 // Modelo del equipo
    $descripcion = ucfirst(strtolower(htmlspecialchars($_POST['descripcion'])));       // Descripción del equipo
    $fecha_creacion = ucfirst(strtolower(htmlspecialchars($_POST['fecha_creacion']))); // Fecha de creación (hidden)

    // Convertir el arreglo de datos en formato SQL
    $datos = "Nombre = '$nombre', Marca = '$marca', Modelo = '$modelo', Descripcion = '$descripcion', Fecha_creacion = '$fecha_creacion'";

    // Crear instancia de la clase IMEC y llamar a la función Actualizar
    $imec = new IMEC();
    $resultado = $imec->Actualizar('equipos', $datos, "Id = '$codigo'");

    // Verificar el resultado de la actualización
    if ($resultado) {
        echo "
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '" . addslashes($nombre) . " ha sido actualizado exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = 'equipos.php';
                });
            </script>
        ";
    } else {
        echo "<script>alert('Error al actualizar el equipo');</script>";
    }
}
?>

<!-- Modal para editar un equipo existente -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Encabezado del modal -->
      <div class="modal-header">
        <!-- Título del modal -->
        <h5 class="modal-title" id="exampleModalLabel">Editar equipo</h5>
        <!-- Botón para cerrar el modal -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Verifica si existe un registro disponible en la variable $row -->
        <?php if (isset($row) && $row): ?>
            <!-- Formulario para editar los datos del equipo -->
            <form action="equipos.php" method="POST" enctype="multipart/form-data">
            
            <!-- Campo oculto para enviar el código del equipo al servidor -->
            <label for="codigo">Código</label>
            <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"/>
            <!-- Campo visible pero deshabilitado para mostrar el código -->
            <input type="number" id="codigo" class="form-control" value="<?php echo $codigo; ?>" disabled/>
            <br>

            <!-- Campo para editar el nombre del equipo -->
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($row['Nombre']); ?>" required/>
            <br>

            <!-- Campo para editar la marca del equipo -->
            <label for="marca">Marca</label>
            <input type="text" id="marca" name="marca" class="form-control" value="<?php echo htmlspecialchars($row['Marca']); ?>" required/>
            <br>

            <!-- Campo para editar el modelo del equipo -->
            <label for="modelo">Modelo</label>
            <input type="text" id="modelo" name="modelo" class="form-control" value="<?php echo htmlspecialchars($row['Modelo']); ?>" required/>
            <br>

            <!-- Campo para editar la descripción del equipo -->
            <label for="descripcion">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo htmlspecialchars($row['Descripcion']); ?>" required/>
            <br>

            <!-- Campo para mostrar la fecha de creación (solo lectura) -->
            <label for="fecha_creacion">Fecha de creación</label>
            <input type="text" id="fecha_creacion" class="form-control" value="<?php echo htmlspecialchars($row['Fecha_creacion']); ?>" disabled/>
            <!-- Campo oculto para enviar la fecha de creación al servidor -->
            <input type="hidden" name="fecha_creacion" value="<?php echo htmlspecialchars($row['Fecha_creacion']); ?>"/>
            <br>

            <!-- Botón para enviar el formulario y actualizar los datos -->
            <button type="submit" name="editar" class="btn btn-success">Actualizar</button>
            </form>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <!-- Botón para cerrar el modal -->
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
