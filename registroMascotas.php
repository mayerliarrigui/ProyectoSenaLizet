<?php
require_once 'conexion.php';

$camposFaltantes = array();

if (!empty($_POST['fullName']) && !empty($_POST['username']) && !empty($_POST['phoneNumber']) && !empty($_POST['password']) && !empty($_POST['gender']) && !empty($_POST['correo'])) {
  $nombre = $_POST['fullName'];
  $raza = $_POST['username'];
  $descripcion = $_POST['phoneNumber'];
  $edad = $_POST['password'];
  $genero = $_POST['gender'];
  $correo = $_POST['correo'];

  // Insertar los datos en la tabla "mascota"
  $queryMascota = "INSERT INTO mascota (nombre, raza, descripcion, edad, genero) VALUES ('$nombre', '$raza', '$descripcion', '$edad', '$genero')";
  if ($con->query($queryMascota) === TRUE) {
    // Obtener el ID de la mascota recién insertada
    $idMascota = mysqli_insert_id($con);

    // Obtener el ID de usuario a partir del correo
    $queryUsuario = "SELECT idUsuario FROM usuario WHERE correo = '$correo'";
    $resultadoUsuario = $con->query($queryUsuario);

    if ($resultadoUsuario->num_rows > 0) {
      $rowUsuario = $resultadoUsuario->fetch_assoc();
      $idUsuario = $rowUsuario['idUsuario'];

      // Insertar los datos en la tabla "postulacionM"
      $queryPostulacion = "INSERT INTO postulacionM (idUsuario, idMascota) VALUES ('$idUsuario', '$idMascota')";
      if ($con->query($queryPostulacion) === TRUE) {
        echo "Datos ingresados correctamente en la tabla 'mascota' y 'postulacionM'";
      } else {
        echo "Error al ingresar los datos en la tabla 'postulacionM': " . $con->error;
      }
    } else {
      echo "No se encontró el usuario con el correo proporcionado";
    }

    // Redirigir a index.html después de 2 segundos
    header("refresh:2;url=index.html");
  } else {
    echo "Error al ingresar los datos en la tabla 'mascota': " . $con->error;
  }
} else {
  if (empty($_POST['fullName'])) {
    $camposFaltantes[] = "Nombre";
  }
  if (empty($_POST['username'])) {
    $camposFaltantes[] = "Raza";
  }
  if (empty($_POST['phoneNumber'])) {
    $camposFaltantes[] = "Descripción";
  }
  if (empty($_POST['password'])) {
    $camposFaltantes[] = "Edad";
  }
  if (empty($_POST['gender'])) {
    $camposFaltantes[] = "Género";
  }
  if (empty($_POST['correo'])) {
    $camposFaltantes[] = "Correo";
  }

  $mensaje = "Faltan los siguientes campos para ingresar los datos: " . implode(", ", $camposFaltantes);
  echo $mensaje;
}

$con->close(); // Cerrar la conexión
?>


