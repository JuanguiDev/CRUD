<!DOCTYPE html>
<html lang="es">
<html>
    <head>
        <title>Caracteristicas de Equipo</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            .container {
                text-align: center;
                margin-top: 50px;
            }
            h1 {
                color: #333;
                font-size: 40px;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin: 0;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            }
        </style>
        <meta charset="utf-8">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Iconos -->
        <script src="https://kit.fontawesome.com/d0afb096b4.js" crossorigin="anonymous"></script>
        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <!-- Alertas -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <?php
            // Se incluyen los archivos necesarios para la conexión a la base de datos y las funcionalidades de la aplicación
            include 'datos_conexion/conexion.php';  // Conexion a la base de datos
            include 'IMEC.php';                     // Funcionalidades del CRUD
            include 'modalEditar.php';              // Ventana modal para editar registros
            include 'modalCrear.php';               // Ventana modal para crear registros
            
            // Verificamos si el parámetro "eliminar" está definido y no es null, esto suceded al dar click en eliminar el registro
            if (isset($_GET["eliminar"])) {
                $eliminar = new IMEC();                             // Creamos una instancia de la clase IMEC
                $codigo = $_GET["codigo"];                          // Obtenemos el valor de "codigo" enviado por el método GET
                $eliminar->Eliminar('equipos', "Id = '$codigo'");   // Llamamos al método Eliminar para borrar el registro correspondiente
            }
        ?>
        <div class="container">
            <br>
            <h1>Características de Equipos</h1>
            <br>
            <!-- Formulario para buscar los equipos por código o marca -->
            <form action="equipos.php" method="GET" class="mb-3">
                <div class="input-group">
                    <!-- Campo para buscar por código -->
                    <input 
                        type="number" 
                        class="form-control" 
                        placeholder="Buscar por codigo" 
                        name="codigo_busqueda" 
                        id="codigo_busqueda"
                        value="<?php echo isset($_GET['codigo_busqueda']) ? htmlspecialchars($_GET['codigo_busqueda']) : ''; ?>" 
                        oninput="toggleInput('marca_busqueda', this)">
                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-search"></i> Buscar</button>
                    <a href="index.php" class="btn btn-secondary ms-2"><i class='fa-solid fa-person-running'></i> Salir</a>
                </div>
                <br>
                <div class="input-group">
                    <!-- Campo para buscar por marca -->
                    <input 
                        type="text" 
                        class="form-control" 
                        placeholder="Buscar por marca" 
                        name="marca_busqueda" 
                        id="marca_busqueda"
                        value="<?php echo isset($_GET['marca_busqueda']) ? htmlspecialchars($_GET['marca_busqueda']) : ''; ?>" 
                        oninput="toggleInput('codigo_busqueda', this)">
                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-search"></i> Buscar</button>
                    <!-- Botón para limpiar el formulario -->
                    <a href="equipos.php" class="btn btn-secondary ms-2"><i class="fa-solid fa-eraser"></i> Limpiar</a>
                </div>
            </form>
            <!-- Script para deshabilitar el otro campo de búsqueda al escribir en uno -->
            <script>
                function toggleInput(otherInputId, currentInput) {
                    const otherInput = document.getElementById(otherInputId);
                    // Deshabilita el otro campo si el actual tiene contenido, lo habilita si está vacío
                    if (currentInput.value.trim() !== "") {
                        otherInput.disabled = true;
                    } else {
                        otherInput.disabled = false;
                    }
                }
            </script>

            <?php
                // Recuperamos los valores de búsqueda enviados por GET, o dejamos vacíos si no existen
                $codigo_busqueda = isset($_GET["codigo_busqueda"]) ? htmlspecialchars($_GET["codigo_busqueda"]) : '';
                $marca_busqueda = isset($_GET["marca_busqueda"]) ? htmlspecialchars($_GET["marca_busqueda"]) : '';
                
                // Validamos para mostrar resultados según el campo de búsqueda utilizado
                if($codigo_busqueda){
                    // Instanciamos la clase IMEC para realizar la búsqueda por código
                    $busqueda = new IMEC();
                    $resultado = $busqueda->ConLista('equipos', "Id LIKE '%$codigo_busqueda%'");

                    echo "<table class='table'>
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Descripción</th>
                                <th>Fecha de creación</th>
                            </tr>
                        </thead>
                        <tbody>";
                    // Iteramos sobre los resultados de la búsqueda
                    while ($row = $resultado->fetch_assoc()){
                        // Escapamos los valores para prevenir ataques XSS
                        $codigo = htmlspecialchars($row['Id']);
                        $nombre = htmlspecialchars($row['Nombre']);
                        $marca = htmlspecialchars($row['Marca']);
                        $modelo = htmlspecialchars($row['Modelo']);
                        $descripcion = htmlspecialchars($row['Descripcion']);
                        $fecha_creacion = htmlspecialchars($row['Fecha_creacion']);

                        // Mostramos los datos en la tabla
                        echo "<tr>
                                <td>$codigo</td>
                                <td>$nombre</td>
                                <td>$marca</td>
                                <td>$modelo</td>
                                <td>$descripcion</td>
                                <td>$fecha_creacion</td>
                                <td>
                                    <a href='equipos.php?editar=true&codigo=$codigo' class='btn btn-success'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='#' class='btn btn-danger btn-eliminar' data-codigo='$codigo'><i class='fa-solid fa-delete-left'></i></a>
                                </td>
                            </tr>";
                    }
                    echo "</tbody></table>";
                }elseif ($marca_busqueda){
                    // Busqueda por marca
                    $busqueda = new IMEC();
                    $resultado = $busqueda->ConLista('equipos', "Marca LIKE '%$marca_busqueda%'");

                    echo "<table class='table'>
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Descripción</th>
                                <th>Fecha de creación</th>
                            </tr>
                        </thead>
                        <tbody>";
                    while ($row = $resultado->fetch_assoc()){
                        // Escapamos valores
                        $codigo = htmlspecialchars($row['Id']);
                        $nombre = htmlspecialchars($row['Nombre']);
                        $marca = htmlspecialchars($row['Marca']);
                        $modelo = htmlspecialchars($row['Modelo']);
                        $descripcion = htmlspecialchars($row['Descripcion']);
                        $fecha_creacion = htmlspecialchars($row['Fecha_creacion']);

                        echo "<tr>
                                <td>$codigo</td>
                                <td>$nombre</td>
                                <td>$marca</td>
                                <td>$modelo</td>
                                <td>$descripcion</td>
                                <td>$fecha_creacion</td>
                                <td>
                                    <a href='equipos.php?editar=true&codigo=$codigo' class='btn btn-success'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='#' class='btn btn-danger btn-eliminar' data-codigo='$codigo'><i class='fa-solid fa-delete-left'></i></a>
                                </td>
                            </tr>";
                    }
                    echo "</tbody></table>";
                }else{
                    // Si no se buscan por código ni por marca, mostramos todos los registros de la tabla
                    $busqueda = new IMEC();
                    $resultado = $busqueda->ConLista('equipos',null);  

                    echo "<table class='table'>
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Descripción</th>
                                <th>Fecha de creación</th>
                                <th>
                                    <!-- Botón para abrir el modal de creación -->
                                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalCrear'>
                                        <i class='fa-solid fa-plus'></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>";
                    while ($row = $resultado->fetch_assoc()){
                        $codigo = htmlspecialchars($row['Id']);
                        $nombre = htmlspecialchars($row['Nombre']);
                        $marca = htmlspecialchars($row['Marca']);
                        $modelo = htmlspecialchars($row['Modelo']);
                        $descripcion = htmlspecialchars($row['Descripcion']);
                        $fecha_creacion = htmlspecialchars($row['Fecha_creacion']);

                        echo "<tr>
                                <td>$codigo</td>
                                <td>$nombre</td>
                                <td>$marca</td>
                                <td>$modelo</td>
                                <td>$descripcion</td>
                                <td>$fecha_creacion</td>
                                <td>
                                    <a href='equipos.php?editar=true&codigo=$codigo' class='btn btn-success'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='#' class='btn btn-danger btn-eliminar' data-codigo='$codigo'><i class='fa-solid fa-delete-left'></i></a>
                                </td>
                            </tr>";
                    }
                    echo "</tbody></table>";
                }
            ?>

        </div>
        <script>
        $(document).ready(function() {
            // Manejo de confirmación para eliminar un registro
            $('.btn-eliminar').on('click', function(e) {
                e.preventDefault();
                var codigo = $(this).data('codigo');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    // Redirecciona para eliiminar el registro
                    if (result.isConfirmed) {
                        window.location.href = 'equipos.php?eliminar=true&codigo=' + codigo;
                    }
                });
            });
        });
    </script>
    </body>
</html>