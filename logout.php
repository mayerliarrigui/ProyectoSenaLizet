<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión.
$_SESSION = array();

// Finalmente, destruir la sesión.
session_destroy();

// Devolver un código de éxito
echo "OK";
exit;
?>
