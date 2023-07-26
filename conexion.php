<?php
$host = "127.0.0.1";
$port = 3306;
$socket = "";
$user = "root";
$password = "";
$dbname = "actividadlizeth";

// Establecer la conexión
$con = new mysqli($host, $user, $password, $dbname, $port, $socket);
if ($con->connect_error) {
    die('Could not connect to the database server: ' . $con->connect_error);
}

?>


