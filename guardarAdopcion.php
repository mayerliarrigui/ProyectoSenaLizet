<?php
require_once 'conexion.php';

$camposFaltantes = array();

if (!empty($_POST['idMascota']) && !empty($_POST['correo'])) {
  $idMascota = $_POST['idMascota'];
  $correo = $_POST['correo'];

  // Obtener el idUsuario a partir del correo
  $queryUsuario = "SELECT idUsuario FROM usuario WHERE correo = '$correo'";
  $resultadoUsuario = $con->query($queryUsuario);

  if ($resultadoUsuario->num_rows > 0) {
    $rowUsuario = $resultadoUsuario->fetch_assoc();
    $idUsuario = $rowUsuario['idUsuario'];

    // Guardar la adopción en la tabla adopcion
    $queryAdopcion = "INSERT INTO adopcion (idUsuario, idMascota) VALUES ('$idUsuario', '$idMascota')";
    if ($con->query($queryAdopcion) === TRUE) {
      echo "Adopción guardada correctamente";
    } else {
      echo "Error al guardar la adopción: " . $con->error;
    }
  } else {
    echo "No se encontró el usuario con el correo proporcionado";
  }
} else {
  if (empty($_POST['idMascota'])) {
    $camposFaltantes[] = "idMascota";
  }
  if (empty($_POST['correo'])) {
    $camposFaltantes[] = "correo";
  }

  $mensaje = "Faltan los siguientes campos para guardar la adopción: " . implode(", ", $camposFaltantes);
  echo $mensaje;
}

$con->close(); // Cerrar la conexión
?>
