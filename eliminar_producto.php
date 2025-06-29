<?php
//  *************************
//  *  ELIMINAR_PRODUCTO.PHP  *
//  *************************
// Eliminar producto seleccionado

// Conexión a la base de datos
require 'conexion.php';

// capturar el parametro id que identifica al producto a eliminar
$id = $_REQUEST['id'];

// Preparar la sentencia
$stmt = $mysqli->prepare("DELETE FROM productos WHERE id = ?");
// Vincular parámetros
$stmt->bind_param("i", $id); // "i" indica que el parámetro es un entero
// Ejecutar la sentencia
$stmt->execute();
// Cerrar la sentencia
$stmt->close();

// muestra listado productos actualizado sin el producto eliminado
header("Location: ver_productos.php");
?>
