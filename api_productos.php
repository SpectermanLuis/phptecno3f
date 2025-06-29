<?php
//  ***********************
//  *  API_PRODUCTOS.PHP  *
//  ***********************
// api basica para ser usada en el front ( catalogo.html )

// Incluye el archivo de conexión a la base de datos (usa $mysqli)
require 'conexion.php';

// Indica que la respuesta será en formato JSON
header('Content-Type: application/json');

$productos = [];

// Ejecuta una consulta SQL para obtener los productos desde la base de datos 
$result = $mysqli->query("SELECT codigo, nombre, categoria, unidad_medida, cantidad, imagen FROM productos");

// Verifica si la consulta obtuvo datos 
// Recorre todas las filas de $result y las agrega al arreglo $productos
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
    $result->free(); 
}

// Convierte el arreglo de productos a formato JSON y lo muestra como salida de la API 
echo json_encode($productos);
?>
