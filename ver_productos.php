<?php
//  ***********************
//  *  VER_PRODUCTOS.PHP  *
//  ***********************
// Ver productos de la base de datos en formato lista 
// con botones para editar o borrar 

// Conexión a la base de datos
require 'conexion.php';

// array vacío para guardar los productos
$productos = [];

// Ejecutar consulta para obtener todos los productos de la base de datos
$result = $mysqli->query("SELECT * FROM productos");

// Si la consulta fue correcta recorremos los resultados y los guardamos en el array $productos
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
    $result->free(); 
}
?>

<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5">
<h1>TECNO 3F - PHP Y MYSQL - TP FINAL - CRUD</h1>
<h2>Lista de Productos</h2>

<!-- Botón para volver al panel principal -->
<a href="dashboard.php" class="btn btn-secondary mb-3">Volver</a>

<!-- Tabla para mostrar los productos -->
<table class="table table-bordered">
  <thead><tr><th>Código</th><th>Nombre</th><th>Categoría</th><th>Unidad</th><th>Cantidad</th><th>Imagen</th><th>Acciones</th></tr></thead>
  <tbody>
  <?php foreach ($productos as $p): ?>
    <tr>
      <td><?= $p['codigo'] ?></td>
      <td><?= $p['nombre'] ?></td>
      <td><?= $p['categoria'] ?></td>
      <td><?= $p['unidad_medida'] ?></td>
      <td><?= $p['cantidad'] ?></td>
      <!-- Si el producto tiene imagen, se visualiza -->
      <td><?php if ($p['imagen']): ?><img src="uploads/<?= $p['imagen'] ?>" width="60"><?php endif; ?></td>
      <td>
        <!-- Botón para editar el producto -->
        <a href="editar_producto.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
        <!-- Botón para eliminar el producto -->
        <a href="eliminar_producto.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este producto?');">Eliminar</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</body>
</html>