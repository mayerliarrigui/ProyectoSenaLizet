<?php
require_once 'conexion.php';

// Verificar si se han enviado los datos del formulario
if (isset($_POST['fullName'], $_POST['username'], $_POST['email'], $_POST['phoneNumber'], $_POST['password'], $_POST['confirmPassword'], $_POST['gender'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['fullName'];
    $apellido = $_POST['username'];
    $correo = $_POST['email'];
    $telefono = $_POST['phoneNumber'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $genero = $_POST['gender'];

    // Validar la contraseña y la confirmación de contraseña
    if ($password !== $confirmPassword) {
        $mensaje = "La contraseña y la confirmación de contraseña no coinciden";
        echo "<script>alert('$mensaje'); window.location.href='login.html';</script>";
        exit;
    }
    echo "<script>alert('Usuario registrado con exito'); window.location.href='Ingresar.html';</script>";

    // Insertar los datos en la tabla "usuario"
    // ...
// Insertar los datos en la tabla "usuario"
$query = "INSERT INTO usuario (tipousuario, nombre, apellido, correo, telefono, contrasenia, genero) VALUES ('usuario', '$nombre', '$apellido', '$correo', '$telefono', '$password', '$genero')";
// ...

    if ($con->query($query) === TRUE) {
        $mensaje = "Registro exitoso";
        echo "<script>alert('$mensaje'); window.location.href='Ingresar.html';</script>";
    } else {
        $mensaje = "Error al ingresar los datos: " . $con->error;
        echo "<script>alert('$mensaje'); window.location.href='Ingresar.html';</script>";
    }

    $con->close(); // Cerrar la conexión
} else {
    // Redirigir al formulario de registro si no se han enviado los datos
    header("Location: login.html");
    exit;
}
?>

