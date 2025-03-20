<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "barberia"; // Cambia el nombre de la BD si es diferente

$conexion = new mysqli($host, $user, $password, $db);
$conexion->set_charset("utf8");

// Verifica si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


?>