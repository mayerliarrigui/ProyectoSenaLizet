<!DOCTYPE html>
<html>
<head>
    <title>Administración de Mascotas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<link rel="stylesheet" href="styles.css">
<body>
    <h1>Administración de Mascotas</h1>

    <?php
    require_once 'conexion.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'agregar':
                    $nombre = $_POST['nombre'];
                    $raza = $_POST['raza'];
                    $descripcion = $_POST['descripcion'];
                    $edad = $_POST['edad'];
                    $genero = $_POST['genero'];

                    $query = "INSERT INTO mascota (nombre, raza, descripcion, edad, genero) VALUES ('$nombre', '$raza', '$descripcion', '$edad', '$genero')";
                    $con->query($query);

                    header("Location: admin.php");
                    exit;
                    break;
                case 'editar':
                    $idMascota = $_POST['idMascota'];
                    $nombre = $_POST['nombre'];
                    $raza = $_POST['raza'];
                    $descripcion = $_POST['descripcion'];
                    $edad = $_POST['edad'];
                    $genero = $_POST['genero'];

                    $query = "UPDATE mascota SET nombre='$nombre', raza='$raza', descripcion='$descripcion', edad='$edad', genero='$genero' WHERE idMascota = $idMascota";
                    $con->query($query);

                    header("Location: admin.php");
                    exit;
                    break;
                case 'eliminar':
                    $idMascota = $_POST['idMascota'];

                    $query = "DELETE FROM mascota WHERE idMascota = $idMascota";
                    $con->query($query);

                    header("Location: admin.php");
                    exit;
                    break;
            }
        }
    }

    $query = "SELECT * FROM mascota";
    $result = $con->query($query);
    ?>

    <table id="tablaMascotas" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Raza</th>
                <th>Descripción</th>
                <th>Edad</th>
                <th>Género</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['idMascota'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['raza'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . $row['edad'] . "</td>";
                echo "<td>" . $row['genero'] . "</td>";
                echo "<td>";
                echo "<button class='btn btn-danger' onclick='eliminarMascota(" . $row['idMascota'] . ")'>Eliminar</button>";
                echo "<button class='btn btn-primary' onclick='editarMascota(" . $row['idMascota'] . ", \"" . $row['nombre'] . "\", \"" . $row['raza'] . "\", \"" . $row['descripcion'] . "\", " . $row['edad'] . ", \"" . $row['genero'] . "\")'>Editar</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="menu_anterior.php" class="btn btn-secondary">Regresar al Menú Anterior</a>

    <button class="btn btn-success" onclick="abrirAgregarMascotaModal()">Agregar Mascota</button>

    <div class="modal fade" id="agregarMascotaModal" tabindex="-1" role="dialog" aria-labelledby="agregarMascotaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarMascotaModalLabel">Agregar Nueva Mascota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="agregarMascotaForm" method="POST">
                        <input type="hidden" name="accion" value="agregar">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" required>
                        <br>
                        <label for="raza">Raza:</label>
                        <input type="text" name="raza" required>
                        <br>
                        <label for="descripcion">Descripción:</label>
                        <input type="text" name="descripcion" required>
                        <br>
                        <label for="edad">Edad:</label>
                        <input type="number" name="edad" required>
                        <br>
                        <label for="genero">Género:</label>
                        <input type="text" name="genero" required>
                        <br>
                        <button type="submit" class="btn btn-success">Agregar Mascota</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editarMascotaModal" tabindex="-1" role="dialog" aria-labelledby="editarMascotaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarMascotaModalLabel">Editar Mascota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editarMascotaForm" method="POST">
                        <input type="hidden" name="accion" value="editar">
                        <input type="hidden" name="idMascota" id="idMascotaInput">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombreInput" required>
                        <br>
                        <label for="raza">Raza:</label>
                        <input type="text" name="raza" id="razaInput" required>
                        <br>
                        <label for="descripcion">Descripción:</label>
                        <input type="text" name="descripcion" id="descripcionInput" required>
                        <br>
                        <label for="edad">Edad:</label>
                        <input type="number" name="edad" id="edadInput" required>
                        <br>
                        <label for="genero">Género:</label>
                        <input type="text" name="genero" id="generoInput" required>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editarMascota(idMascota, nombre, raza, descripcion, edad, genero) {
            document.getElementById('idMascotaInput').value = idMascota;
            document.getElementById('nombreInput').value = nombre;
            document.getElementById('razaInput').value = raza;
            document.getElementById('descripcionInput').value = descripcion;
            document.getElementById('edadInput').value = edad;
            document.getElementById('generoInput').value = genero;
            $('#editarMascotaModal').modal('show');
        }

        function abrirAgregarMascotaModal() {
            $('#agregarMascotaModal').modal('show');
        }

        function eliminarMascota(idMascota) {
            if (confirm('¿Estás seguro de que quieres eliminar esta mascota?')) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = 'admin.php';
                let accion = document.createElement('input');
                accion.type = 'hidden';
                accion.name = 'accion';
                accion.value = 'eliminar';
                let id = document.createElement('input');
                id.type = 'hidden';
                id.name = 'idMascota';
                id.value = idMascota;
                form.appendChild(accion);
                form.appendChild(id);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

