<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="adoptame.css">
</head>
<body>

<h1>Listado de Mascotas</h1>

<table id="customers">
  <tr>
    <th>Nombre</th>
    <th>Edad</th>
    <th>Raza</th>
    <th>Contactame</th>
  </tr>
  <?php
  require_once 'conexion.php';

  // Consultar los datos de las mascotas
  $query = "SELECT * FROM mascota";
  $resultado = $con->query($query);

  if ($resultado->num_rows > 0) {
    // Generar las filas de la tabla con los datos de las mascotas
    while ($row = $resultado->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['nombre'] . "</td>";
      echo "<td>" . $row['edad'] . "</td>";
      echo "<td>" . $row['raza'] . "</td>";
      echo "<td><button onclick=\"guardarAdopcion(" . $row['idMascota'] . ")\">Contactame</button></td>";
      echo "</tr>";
    }
  } else {
    // No se encontraron mascotas en la base de datos
    echo "<tr><td colspan='4'>No se encontraron mascotas.</td></tr>";
  }

  $con->close(); // Cerrar la conexión
  ?>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function guardarAdopcion(idMascota) {
  var correo = localStorage.getItem('correo');

  $.ajax({
    url: 'guardarAdopcion.php',
    type: 'POST',
    data: {
      idMascota: idMascota,
      correo: correo
    },
    success: function(response) {
      // Mostrar alerta con la respuesta del servidor
      alert("Datos enviados a guardarAdopcion.php:\n\nID Mascota: " + idMascota + "\nCorreo: " + correo);
      alert(response);
    },
    error: function(xhr, status, error) {
      alert("Error al guardar la adopción");
      console.log(xhr.responseText);
    }
  });
}
</script>

</body>
</html>

