<?php

//  *******************
//  *  DASHBOARD.PHP  *
//  *******************
// Pantalla principal del crud 

// Conexión a la base de datos
require 'conexion.php';

// Verificación de sesión activa: si no hay usuario logueado, se redirige al login
if (!isset($_SESSION['usuario_id'])) header("Location: login.php");
?>
<!DOCTYPE html>
<html>
   <!-- Bootstrap para estilos -->
  <head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
  <body class="container mt-5">
    <h1>TECNO 3F - PHP Y MYSQL - TP FINAL - CRUD</h1>
    <h2>Panel de Control</h2>
    <!-- Botón para ir a crear un nuevo producto -->
    <a href="crear_producto.php" class="btn btn-success">Agregar Producto</a>
    <!-- Botón para ver todos los productos -->
    <a href="ver_productos.php" class="btn btn-primary">Ver Productos</a>
      <!-- Botón para cerrar la sesion -->
    <a href="logout.php" class="btn btn-secondary">Salir</a>
  </body>
</html>