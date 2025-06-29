<?php
//  ******************
//  *  CONEXION.PHP  *
//  ******************
// Conexion con la base de datos 

// datos a usar en la conexion
$host = 'localhost'; // Ubicacion
$db   = 'phpcrud3f';    // Nombre de la base de datos
$user = 'root';      // Usuario de MySQL
$pass = '';          // Contraseña de MySQL
$port = 3307;        // Puerto MySQL
$charset = 'utf8mb4';

// Crear una nueva conexión MySQLi con el puerto especificado
$mysqli = new mysqli($host, $user, $pass, $db, $port);

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Establecer el juego de caracteres
$mysqli->set_charset($charset);

// Configurar MySQLi para que lance excepciones en caso de error 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();
?>