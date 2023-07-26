<?php
require_once 'conexion.php';

if (isset($_POST['email'], $_POST['password'])) {
    // Obtener los datos del formulario
    $correo = $_POST['email'];
    $password = $_POST['password'];

    // Consultar el usuario en la tabla "usuario"
    $query = "SELECT tipousuario FROM usuario WHERE correo = '$correo' AND contrasenia = '$password'";
    $result = $con->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $tipousuario = $row['tipousuario'];

            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["correo"] = $correo;
            $_SESSION["tipousuario"] = $tipousuario;

        // Guardar el correo en una constante
        define('CORREO', $correo);

        // Imprimir el código JavaScript para asignar el valor al localStorage
        echo "<script>localStorage.setItem('correo', '" . $correo . "');</script>";

        // Verificar el tipo de usuario y redirigir a la página correspondiente
        if ($tipousuario === 'administrador') {
            // Redirigir a la página para los administradores
            echo "<script>window.location.href = 'Admin.php';</script>";
            exit;
        } else {
            // Redirigir a la página principal
            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        }
    } else {
        // Credenciales inválidas, mostrar mensaje de error
        echo "<script>alert('Credenciales incorrectas'); window.location.href='ingresar.html';</script>";
        exit;
    }
}

// Redirigir al formulario de ingreso si no se han enviado los datos
echo "<script>window.location.href = 'ingresar.html';</script>";
exit;
?>


